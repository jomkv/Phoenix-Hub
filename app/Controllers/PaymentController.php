<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;

use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ProductModel;
use App\Models\VariationModel;

class PaymentController extends BaseController
{
  private OrderModel $orderModel;
  private OrderItemModel $orderItemModel;
  private ProductModel $productModel;
  private VariationModel $variantModel;
  private $studentModel;
  private $db;

  public function __construct()
  {
    $this->orderModel = new OrderModel();
    $this->orderItemModel = new OrderItemModel();
    $this->productModel = new ProductModel();
    $this->variantModel = new VariationModel();
    $this->studentModel = auth()->getProvider();
    $this->db = \Config\Database::connect();
  }

  /**
   * Paymongo Webhook
   * Status: Disabled
   * Note: Still not implemented
   */
  public function webhook()
  {
    $data = $this->request->getJSON();

    // * Get event type
    $checkoutSessionId = $data->data->id ?? null;

    // * If event matches and id exists 
    if ($checkoutSessionId) {
      try {
        $this->processPayment($checkoutSessionId);
      } catch (\Exception $e) {
        return $this->response->setStatusCode(200);
      }
    }

    // * Webhooks must always return 2xx response
    return $this->response->setStatusCode(200);
  }

  public function success()
  {
    $sessionId = session()->get('session_id');

    if (!$this->isPaymentSuccess($sessionId)) {
      return redirect()->back("/")->with("error", "Error, payment didn't go through.");
    }

    $order = $this->orderModel->where("payment_reference", $sessionId)->first();

    if (!$order) {
      return redirect()->to("/")->with("error", "Error, order not found.");
    }

    // * If all goes well, process order (update stocks, status etc)
    try {
      // * Get items associated with the order
      $orderItems = $this->orderItemModel->where("order_id", $order->order_id)->findAll();

      // * Start Transaction
      $this->db->transException(true)->transStart();

      // * Update product stock
      foreach ($orderItems as $item) {
        if ($item->is_variant) {
          $variant = $this->getVariantOrError($item->variant_id);

          // * Subtract order item quantity from variant stock count
          $newStock = $variant->stock - $item->quantity;
          $variant->stock = $newStock;
          $this->variantModel->save($variant);
        } else {
          $product = $this->getProductOrError($item->product_id);

          // * Subtract order item quantity from product stock count
          $newStock = $product->stock - $item->quantity;
          $product->stock = $newStock;
          $this->productModel->save($product);
        }
      }

      // * Update order status
      $order->status = "confirmed";
      $order->is_paid = true;
      $this->orderModel->save($order);

      // * Complete Transaction
      $this->db->transComplete();

      // * Notify student
      $this->orderConfirmEmail($order->student_id, $order->order_id);

      return redirect()->to("/")->with("message", "Payment received, order confirmed.");
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with("devError", $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with("devError", $e->getMessage());
    } catch (DatabaseException $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with("devError", $e->getMessage());
    }
  }

  public function fail()
  {
    $sessionId = session()->get('session_id');

    if ($sessionId) {
      $order = $this->orderModel->where("payment_reference", $sessionId)->first();

      $order->status = "cancelled";
      $this->orderModel->save($order);

      $this->orderCancelEmail($order->student_id, $order->order_id);
    }

    return redirect()->to("/")->with("info", "Your payment was not received.");
  }

  private function processPayment($checkoutSessionId)
  {
    $order = $this->orderModel->where("payment_reference", $checkoutSessionId)->first();

    if ($order) {
      $order->is_paid = true;
      $this->orderModel->save($order);
    }
  }

  private function isPaymentSuccess($sessionId)
  {
    try {
      if ($sessionId) {
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => 'https://api.paymongo.com/v1/checkout_sessions/' . $sessionId,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => [
            'Authorization: Basic ' . base64_encode(getenv('paymongo.secret'))
          ],
        ]);
        $rawRes = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $res = json_decode($rawRes);

        // * If payment detected
        if (isset($res->data->attributes->paid_at)) {
          return true;
        }

        return false;
      } else {
        return false;
      }
    } catch (\Exception $e) {
      return false;
    }
  }

  private function getProductOrError($productId)
  {
    $product = $this->productModel->withDeleted()->find($productId);

    if ($product === null) {
      throw new \LogicException("Product not found");
    }

    return $product;
  }

  private function getVariantOrError($variantId)
  {
    $variant = $this->variantModel->withDeleted()->find($variantId);

    if ($variant === null) {
      throw new \LogicException("Product Variant not found");
    }

    return $variant;
  }

  private function getOrderOrError($orderId)
  {
    $order = $this->orderModel->find($orderId);

    if ($order === null) {
      throw new \LogicException("Order not found");
    }

    return $order;
  }

  private function orderConfirmEmail($studentId, $orderId)
  {
    $order =  $order = $this->orderModel->find($orderId);
    $student = $this->studentModel->findById($studentId);

    $email = \Config\Services::email();

    $email->setTo($student->getEmail());
    $email->setSubject("Your Phoenix Hub Order Confirmed - [Order ID: " . $orderId . "]");
    $email->setMessage(<<<EOT
<p>Hi {$student->full_name},</p>
<p>Great news! Your order from Phoenix Hub has been paid and confirmed and is now being processed for pick-up.</p>
<br>
<h4>Order Details:</h4>
<ul>
  <li>Order ID: {$orderId}</li>
  <li>Pick-Up Location: CvSU SIlang Gymnasium</li>
  <li>Pick-Up Date and Time: {$order->pickup_date} {$order->pickup_time}</li>
  <li>Order Total Amount: ₱{$order->total}</li>
</ul>
<br>
<h4>Next Steps:</h4>
<p>Please prepare for pick-up at the designated time and place.</p>
<p>We look forward to seeing you!</p>
<br>
<br>
<p>Sincerely,</p>
<p>The Phoenix Hub Team</p>
EOT);

    $email->send();
  }


  private function orderCancelEmail($studentId, $orderId)
  {
    $order =  $order = $this->orderModel->find($orderId);
    $student = $this->studentModel->findById($studentId);

    $email = \Config\Services::email();

    $email->setTo($student->getEmail());
    $email->setSubject("Phoenix Hub Order Update - [Order ID: " . $orderId . "]");
    $email->setMessage(<<<EOT
<p>Hi {$student->full_name},</p>
<p>We're writing to inform you that your order from Phoenix Hub (Order ID: {$orderId}) has been cancelled.</p>
<p>This is due to the fact that your online payment was not successful.</p>
<p>We apologize for any inconvenience this may cause.</p>
<br>
<p>**If you have any questions regarding the cancellation, please don't hesitate to contact us.**</p>
<p>Sincerely,</p>
<p>The Phoenix Hub Team</p>
EOT);

    $email->send();
  }
}
