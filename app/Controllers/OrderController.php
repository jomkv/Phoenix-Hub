<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\CartItemModel;
use App\Models\ProductModel;

use App\Entities\Order;
use App\Entities\OrderItem;
use App\Entities\CartItem;
use App\Entities\Product;

class OrderController extends BaseController
{
  private OrderItemModel $orderItemModel;
  private OrderModel $orderModel;
  private CartItemModel $cartItemModel;
  private ProductModel $productModel;
  private $studentModel;
  private $db;

  public function __construct()
  {
    $this->orderItemModel = new OrderItemModel();
    $this->orderModel = new OrderModel();
    $this->cartItemModel = new CartItemModel();
    $this->productModel = new ProductModel();
    $this->studentModel = auth()->getProvider();
    $this->db = \Config\Database::connect();
  }

  public function createOrder($studentId)
  {
    try {
      //$student = $this->getStudentOrError($studentId);

      // Get all student's cart items
      //$cartItems = $this->cartItemModel->where("student_id", $studentId)->findAll();

      // create order 
      // create order items 

      // delete all student's cart items

    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.");
    }
  }

  /**
   * @desc confirm order
   * @route POST /admin/order/confirm/:id
   * @access private
   */
  public function confirmOrder($orderId)
  {
    try {
      $order = $this->getOrderOrError($orderId);

      // * Get items associated with the order
      $orderItems = $this->orderItemModel->where("order_id", $orderId)->findAll();

      // * Start Transaction
      $this->db->transException(true)->transStart();

      // * Update product stock
      foreach ($orderItems as $item) {
        $product = $this->getProductOrError($item->product_id);

        // * Subtract order item quantity from product stock count
        $newStock = $product->stock - $item->quantity;
        $product->stock = $newStock;
        $this->productModel->save($product);
      }

      // * Update order status
      $order->status = "confirmed";
      $this->orderModel->save($order);

      // * Complete Transaction
      $this->db->transComplete();

      // * Notify student
      $this->orderConfirmEmail($order->student_id, $orderId);

      return redirect()->back()->with("message", "Order confirmed.");
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->back()->with('error', "Error, please try again later.");
    } catch (DatabaseException $e) {
      return redirect()->back()->with('error', "Error, please try again later.");
    }
  }

  private function getOrderOrError($orderId)
  {
    $order = $this->orderModel->find($orderId);

    if ($order === null) {
      throw new \LogicException("Order not found");
    }

    return $order;
  }

  private function getProductOrError($productId)
  {
    $product = $this->productModel->withDeleted()->find($productId);

    if ($product === null) {
      throw new \LogicException("Product not found");
    }

    return $product;
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
<p>Great news! Your order from Phoenix Hub has been confirmed and is now being processed for pick-up.</p>
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
<p>Please prepare the exact amount of ₱{$order->total} for your order upon pick-up at the designated time and place.</p>
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
<p>We apologize for any inconvenience this may cause.</p>
<br>
<p>**If you have any questions regarding the cancellation, please don't hesitate to contact us.**</p>
<p>Sincerely,</p>
<p>The Phoenix Hub Team</p>
EOT);

    $email->send();
  }

  private function orderPickupEmail($studentId, $orderId)
  {
    $order =  $order = $this->orderModel->find($orderId);
    $student = $this->studentModel->findById($studentId);

    $email = \Config\Services::email();

    $email->setTo($student->getEmail());
    $email->setSubject("Your Phoenix Hub Order Picked Up - [Order ID: " . $orderId . "]");
    $email->setMessage(<<<EOT
<p>Hi {$student->full_name},</p>
<p>This email confirms that your Phoenix Hub order (Order ID: {$order->id}) has been picked up.</p>
<p>We hope you enjoy your order!</p>
<br>
<p>**If you have any questions or concerns, please don't hesitate to contact us.**</p>
<p>Thank you for choosing Phoenix Hub!</p>
<p>Sincerely,</p>
<p>The Phoenix Hub Team</p>
EOT);

    $email->send();
  }
}
