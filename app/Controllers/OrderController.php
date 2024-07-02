<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\CartItemModel;
use App\Models\ProductModel;
use App\Models\VariationModel;

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
  private VariationModel $variantModel;
  private $studentModel;
  private $db;

  public function __construct()
  {
    $this->orderItemModel = new OrderItemModel();
    $this->orderModel = new OrderModel();
    $this->cartItemModel = new CartItemModel();
    $this->productModel = new ProductModel();
    $this->variantModel = new VariationModel();
    $this->studentModel = auth()->getProvider();
    $this->db = \Config\Database::connect();
  }

  /**
   * @desc Get order details
   * @route POST /admin/order/details/:orderId
   * @access private
   */
  public function getOrderDetails($orderId)
  {
    try {
      $order = $this->getOrderOrError($orderId);
      $orderItems = $this->orderItemModel->where("order_id", $orderId)->findAll();

      $orderItemPayload = [];

      foreach ($orderItems as $item) {
        $product = null;
        $variant = null;

        if ($item->is_variant) {
          $variant = $this->getVariantOrError($item->variant_id);
          $product = $this->getProductOrError($variant->product_id);
        } else {
          $product = $this->getProductOrError($item->product_id);
        }

        $currPayload = [
          "item"    => $item,
          "product" => $product,
          "variant" => $variant
        ];

        array_push($orderItemPayload, $currPayload);
      }

      $payload = [
        "order" => $order,
        "orderItems" => $orderItemPayload
      ];

      return $this->response->setStatusCode(200)->setJSON($payload);
    } catch (\Exception $e) {
      return $this->response->setStatusCode(500)->setJSON(['message' => 'Error occurred']);
    } catch (\LogicException $e) {
      return $this->response->setStatusCode(400)->setJSON(['message' => $e->getMessage()]);
    }
  }

  /**
   * @desc Returns a view to a specific product's checkout page
   * @route GET /checkout/product/:productId
   * @access private
   */
  public function viewBuyProduct($productId)
  {
    try {
      $product = $this->getProductOrError($productId, false);

      $quantity = $this->request->getVar("quantity");

      if (!is_numeric($quantity)) {
        return redirect()->back()->with("error", "Error, invalid quantity.");
      }

      if ((int) $quantity > $product->stock) {
        return redirect()->back()->with("error", "Error, not enough stock.");
      }

      return view("pages/product/buyNowProductForm", ["product" => $product, "quantity" => $quantity]);
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "Error, please try again later.");
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  /**
   * @desc Returns a view to a specific variant's checkout page
   * @route GET /checkout/variant/:variantId
   * @access private
   */
  public function viewBuyVariant($variantId)
  {
    try {
      $variant = $this->getVariantOrError($variantId, false);
      $product = $this->getProductOrError($variant->product_id, false);

      $quantity = $this->request->getVar("quantity");

      if (!is_numeric($quantity)) {
        return redirect()->back()->with("error", "Error, invalid quantity.");
      }

      if ((int) $quantity > $variant->stock) {
        return redirect()->back()->with("error", "Error, not enough stock.");
      }

      return view("pages/product/buyNowVariantForm", ["product" => $product, "variant" => $variant, "quantity" => $quantity]);
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "Error, please try again later.");
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  /**
   * @desc checkout a specific product
   * @route POST /checkout/product/:productId
   * @access private
   */
  public function buyProduct($productId)
  {
    try {
      $product = $this->getProductOrError($productId);
      $data = $this->request->getPost();
      $data["quantity"] = (int) $data["quantity"];

      // * Check if quantity exceeds stock
      if ($data["quantity"] > $product->stock) {
        return redirect()->back()->with("errors", "Not enough stock.");
      }

      // * Update data
      $data["student_id"] = auth()->id();
      $data["total"] = 0;

      // * Validate data
      if (!$this->orderModel->validate($data)) {
        return redirect()->back()
          ->with('errors', $this->orderModel->errors())
          ->withInput();
      }

      // * Start transaction
      $this->db->transException(true)->transStart();

      // * Create order
      $orderId = $this->orderModel->insert($data);
      $order = $this->getOrderOrError($orderId);

      // * Create order item
      $orderTotal = $product->price * $data["quantity"];

      $newOrderItem = [
        "order_id"      => $orderId,
        "product_id"    => $productId,
        "quantity"      => $data["quantity"],
        "is_variant"    => false,
        "item_total"    => $orderTotal
      ];

      if (!$this->orderItemModel->insert($newOrderItem)) {
        return throw new DatabaseException("Error creating new order item.");
      }

      // * Update order total
      $order->total += $orderTotal;
      $this->orderModel->save($order);

      if ($data["payment_method"] === "online") {
        $res = $this->getCheckoutSessionOrError($newOrderItem);

        $this->orderModel->update($orderId, [
          "payment_reference" => $res["id"]
        ]);

        // * Complete Transaction
        $this->db->transComplete();

        return redirect()->to($res["url"]);
      } else {
        $this->orderSentEmail($order->student_id, $orderId);

        // * Complete Transaction
        $this->db->transComplete();

        return redirect()->to("/")->with("message", "Order Submitted");
      }
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "Error, please try again later.");
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    } catch (DatabaseException $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with('devErr', $e->getMessage());
    }
  }

  /**
   * @desc checkout a specific variant
   * @route POST /checkout/variant/:variantId
   * @access private
   */
  public function buyVariant($variantId)
  {
    try {
      $variant = $this->getVariantOrError($variantId);
      $data = $this->request->getPost();
      $data["quantity"] = (int) $data["quantity"];

      // * Check if quantity exceeds stock
      if ($data["quantity"] > $variant->stock) {
        return redirect()->back()->with("errors", "Not enough stock.");
      }

      // * Update data
      $data["student_id"] = auth()->id();
      $data["total"] = 0;

      // * Start transaction
      $this->db->transException(true)->transStart();

      // * Create order
      $orderId = $this->orderModel->insert($data);
      $order = $this->getOrderOrError($orderId);

      // * Create order item
      $orderTotal = $variant->price * $data["quantity"];

      $newOrderItem = [
        "order_id"      => $orderId,
        "variant_id"    => $variantId,
        "quantity"      => $data["quantity"],
        "is_variant"    => true,
        "item_total"    => $orderTotal
      ];

      if (!$this->orderItemModel->insert($newOrderItem)) {
        return throw new DatabaseException("Error creating new order item.");
      }

      // * Update order total
      $order->total += $orderTotal;
      $this->orderModel->save($order);

      if ($data["payment_method"] === "online") {
        $res = $this->getCheckoutSessionOrError($newOrderItem);

        $this->orderModel->update($orderId, [
          "payment_reference" => $res["id"]
        ]);

        // * Complete Transaction
        $this->db->transComplete();

        return redirect()->to($res["url"]);
      } else {
        $this->orderSentEmail($order->student_id, $orderId);

        // * Complete Transaction
        $this->db->transComplete();

        return redirect()->to("/")->with("message", "Order Submitted");
      }
    } catch (\Exception $e) {
      return redirect()->back()->with("error", "Error, please try again later.")->with('devErr', $e->getMessage());
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    } catch (DatabaseException $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with('devErr', $e->getMessage());
    }
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
      $this->orderModel->save($order);

      // * Complete Transaction
      $this->db->transComplete();

      // * Notify student
      $this->orderConfirmEmail($order->student_id, $orderId);

      return redirect()->back()->with("message", "Order confirmed.");
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->back()->with('error', "Error, please try again later.")->with("devErr", $e->getMessage());
    } catch (DatabaseException $e) {
      return redirect()->back()->with('error', "Error, please try again later.")->with("devErr", $e->getMessage());
    }
  }

  /**
   * @desc mark order as received
   * @route POST /admin/order/receive/:id
   * @access private
   */
  public function receiveOrder($orderId)
  {
    try {
      $order = $this->getOrderOrError($orderId);

      // * Update order status
      $order->status = "received";
      if (!$this->orderModel->save($order)) {
        return redirect()->back()->with("error", "Error, unable to receive order.");
      }

      // * Notify student
      $this->orderPickupEmail($order->student_id, $orderId);

      return redirect()->back()->with("message", "Order received.");
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->back()->with('error', "Error, please try again later.")->with("devErr", $e->getMessage());
    }
  }

  /**
   * @desc cancel order
   * @route POST /admin/order/cancel/:id
   * @access private
   */
  public function cancelOrder($orderId)
  {
    try {
      $order = $this->getOrderOrError($orderId);

      // * Update order status
      $order->status = "cancelled";
      if (!$this->orderModel->save($order)) {
        return redirect()->back()->with("error", "Error, unable to cancel order.");
      }

      // * Notify student
      $this->orderCancelEmail($order->student_id, $orderId);

      return redirect()->back()->with("message", "Order cancelled.");
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->back()->with('error', "Error, please try again later.")->with("devErr", $e->getMessage());
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

  private function getProductOrError($productId, $withDeleted = true)
  {
    $product = null;

    if ($withDeleted) {
      $product = $this->productModel->withDeleted()->find($productId);
    } else {
      $product = $this->productModel->find($productId);
    }

    if ($product === null) {
      throw new \LogicException("Product not found");
    }

    return $product;
  }

  private function getVariantOrError($variantId, $withDeleted = true)
  {
    $variant = null;

    if ($withDeleted) {
      $variant = $this->variantModel->withDeleted()->find($variantId);
    } else {
      $variant = $this->variantModel->find($variantId);
    }

    if ($variant === null) {
      throw new \LogicException("Product Variant not found");
    }

    return $variant;
  }

  private function getCheckoutSessionOrError($orderItem)
  {
    $lineItems = [];

    // * Convert order item to line item
    if ($orderItem["is_variant"]) {
      $variant = $this->getVariantOrError($orderItem["variant_id"]);
      $product = $this->getProductOrError($variant->product_id);

      $lineItem = [
        'currency'    => 'PHP',
        'amount'      => round($variant->price * 100, 0), // round off
        'description' => $product->description,
        'name'        => $product->product_name . "[" . $product->variation_name . ": " . $variant->option_name . "]",
        'quantity'    => $orderItem["quantity"]
      ];

      array_push($lineItems, $lineItem);
    } else {
      $product = $this->getProductOrError($orderItem["product_id"]);

      $lineItem = [
        'currency'    => 'PHP',
        'amount'      => round($product->price * 100, 0), // round off
        'description' => $product->description,
        'name'        => $product->product_name,
        'quantity'    => $orderItem["quantity"]
      ];

      array_push($lineItems, $lineItem);
    }


    $data = [
      'data' => [
        'attributes' => [
          'line_items' => $lineItems,
          'payment_method_types' => [
            'card',
            'paymaya',
            'gcash',
            'grab_pay',
          ],
          'success_url' => url_to('PaymentController::success'),
          'cancel_url' => url_to('PaymentController::fail'),
          'description' => 'Phoenix Hub Merchandise'
        ],
      ]
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => 'https://api.paymongo.com/v1/checkout_sessions',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode(getenv('paymongo.secret'))
      ]
    ]);

    $response = curl_exec($curl);

    // * If paymongo error
    if ($curlError = curl_error($curl)) {
      curl_close($curl);
      log_message('error', 'Payment error: ' . $curlError);
      return throw new \LogicException($curlError);
    }

    curl_close($curl);
    $responseData = json_decode($response);

    $sessionId = $responseData->data->id ?? null;
    $checkoutUrl = $responseData->data->attributes->checkout_url ?? null;

    // * If session id and checkout url created
    if (!$sessionId || !$checkoutUrl) {
      return throw new \LogicException("Error, unable to create checkout session." . $sessionId . $checkoutUrl);
    }

    session()->set('session_id', $responseData->data->id);
    return [
      "id"        => $sessionId,
      "url"       => $checkoutUrl
    ];
  }

  private function orderSentEmail($studentId, $orderId)
  {
    $order =  $order = $this->orderModel->find($orderId);
    $student = $this->studentModel->findById($studentId);

    $email = \Config\Services::email();

    $email->setTo($student->getEmail());
    $email->setSubject("Your Order From Phoenix Hub - [Order ID: " . $orderId . "]");
    $email->setMessage(<<<EOT
<p>Hi {$student->full_name},</p>
<p>Thank you for your order from Phoenix Hub! We've received your order details and it's currently under review.</p>
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
<p>Our team will review your order for availability and processing. You will receive a separate email notification confirming your order or notifying you of any cancellations.</p>
<p>Please don't hesitate to contact us if you have any questions.</p>
<br>
<br>
<p>Sincerely,</p>
<p>The Phoenix Hub Team</p>
EOT);

    $email->send();
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
