<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;

use App\Models\CartItemModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\VariationModel;

use App\Entities\CartItem;
use App\Entities\Product;
use App\Entities\Order;
use App\Entities\OrderItem;

class CartController extends BaseController
{
  private CartItemModel $cartItemModel;
  private ProductModel $productModel;
  private OrderModel $orderModel;
  private OrderItemModel $orderItemModel;
  private VariationModel $variantModel;
  private $studentModel;
  private $db;

  public function __construct()
  {
    $this->productModel = new ProductModel();
    $this->cartItemModel = new CartItemModel();
    $this->orderModel = new OrderModel();
    $this->orderItemModel = new OrderItemModel();
    $this->variantModel = new VariationModel();
    $this->studentModel = auth()->getProvider();;
    $this->db = \Config\Database::connect();
  }


  /**
   * @desc Returns view to current logged in user's cart 
   * @route GET /cart
   * @access private
   */
  public function viewCart()
  {
    try {
      // Get all student's cart items
      $items = $this->cartItemModel->where("student_id", auth()->id())->findAll();
      $cartItems = [];

      for ($i = 0; $i < count($items); $i++) {
        $productId = $items[$i]->product_id;

        $payload = [
          "cartItem" => $items[$i],
          "product"  => $this->getProductOrError($productId),
          "variant" => $this->variantModel->where("variation_id", $items[$i]->variant_id)->first() ?? null
        ];

        $cartItems[$i] = $payload;
      }

      return view('pages/product/cart.php', ["cartItems" => $cartItems]);
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.");
    }
  }

  /**
   * @desc Adds a product/variant to cart
   * @route POST /cart/add
   * @access private
   */
  public function addToCart()
  {
    try {
      // * Properties
      $data = $this->request->getPost();
      $productId = $data["product_id"];
      $quantity = (int) $data["quantity"];
      $studentId = auth()->id();
      $hasVariant = $data["has_variants"]; // If prod has no variants, data["variantId"] will be nonexistent 

      // * Check if cart item exists, if so then update it
      if ($hasVariant) {
        // * Check if variant exists
        $variant = $this->getVariantOrError($data["variantId"]);

        // * Check if cart item exists
        $existingCartItem = $this->cartItemModel
          ->where("student_id", $studentId)
          ->where("is_variant", true)
          ->where("variant_id", $variant->variation_id)
          ->first();

        // * Update the existing cart item instead if it exists
        if ($existingCartItem) {
          // * Check if quantity will exceed stock
          if (($existingCartItem->quantity + $quantity) > $variant->stock) {
            return redirect()->back()->with("error", "Unable to add to cart, not enough stocks.");
          }

          // * Update quantity 
          $existingCartItem->quantity += $quantity;

          $isSuccess = $this->cartItemModel->save($existingCartItem);

          if ($isSuccess) {
            return redirect()->back()->with("message", "Item added to cart.");
          } else {
            return redirect()->back()->with("error", "Unable to add item to cart.");
          }
        }
      } else {
        // * Check if product exists
        $product = $this->getProductOrError($productId);

        // * Check if cart item exists
        $existingCartItem = $this->cartItemModel
          ->where("student_id", $studentId)
          ->where("is_variant", false)
          ->where("product_id", $productId)
          ->first();

        // * Update the existing cart item instead if it exists
        if ($existingCartItem) {
          // * Check if quantity will exceed stock
          if (($existingCartItem->quantity + $quantity) > $product->stock) {
            return redirect()->back()->with("error", "Unable to add to cart, not enough stocks.");
          }

          // * Update quantity 
          $existingCartItem->quantity += $quantity;

          $isSuccess = $this->cartItemModel->save($existingCartItem);

          if ($isSuccess) {
            return redirect()->back()->with("message", "Item added to cart.");
          } else {
            return redirect()->back()->with("error", "Unable to add item to cart.");
          }
        }
      }

      // * New cart item
      $newCartItem = [];

      if ($hasVariant) {
        // * Check if variant exists
        $variant = $this->getVariantOrError($data["variantId"]);

        // * Check if quantity exceeds variant stock
        if ($quantity > $variant->stock) {
          return redirect()->back()->with("error", "Unable to add to cart, not enough stock.");
        }

        // * Create new cart item
        $newCartItem = new CartItem([
          "student_id" => $studentId,
          "product_id" => $productId,
          "variant_id" => $variant->variation_id,
          "is_variant" => true,
          "quantity"   => $quantity,
        ]);
      } else {
        // * Check if product exists
        $product = $this->getProductOrError($productId);

        // * Check if quantity exceeds product stock
        if ($quantity > $product->stock) {
          return redirect()->back()->with("error", "Unable to add to cart, not enough stocks.");
        }

        // * Create new cart item
        $newCartItem = new CartItem([
          "student_id" => auth()->id(),
          "product_id" => $productId,
          "is_variant" => false,
          "quantity"   => $quantity,
        ]);
      }

      // Get all student's cart items
      $isSuccess = $this->cartItemModel->save($newCartItem);

      if ($isSuccess) {
        return redirect()->back()->with("message", "Item added to cart");
      } else {
        return redirect()->back()->with("error", "Unable to add to cart");
      }
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with('devError', $e->getMessage());
    }
  }

  /**
   * @desc edit a cart item's quantity
   * @route POST /cart/edit/:cartItemId
   * @access private
   */
  public function editCartItem($cartItemId)
  {
    try {
      $cartItem = $this->getCartItemOrError($cartItemId);
      $data = $this->request->getPost();
      $quantity = (int) $data["quantity"];

      // * Check if quantity exceeds stock
      if ($cartItem->is_variant && $cartItem->variant_id) {
        $variant = $this->getVariantOrError($cartItem->variant_id);

        if ($quantity > $variant->stock) {
          return redirect()->back()->with("error", "Unable to update cart item, not enough stock.");
        }
      } else if (!$cartItem->is_variant && $cartItem->product_id) {
        $product = $this->getProductOrError($cartItem->product_id);

        if ($quantity > $product->stock) {
          return redirect()->back()->with("error", "Unable to update cart item, not enough stock.");
        }
      }

      // * Update cart item quantity
      if ($quantity <= 0) {
        // * Delete if quantity less than 0
        $this->cartItemModel->delete($cartItem->cart_item_id);
      } else {
        $cartItem->quantity = $quantity;
        $this->cartItemModel->save($cartItem);
      }

      return redirect()->to("/cart")->with("message", "Cart item updated.");
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with("devErr", $e->getMessage());
    }
  }

  /**
   * @desc removes a product from cart
   * @route POST /cart/remove/:cartItemId
   * @access private
   */
  public function deleteCartItem($cartItemId)
  {
    try {
      $cartItem = $this->getCartItemOrError($cartItemId);

      $this->cartItemModel->delete($cartItem->cart_item_id);

      return redirect()->to("/cart")->with("message", "Item removed from cart.");
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.");
    }
  }

  /**
   * @desc view checkout form
   * @route GET /cart/checkout/
   * @access private
   */
  public function viewCheckoutCart()
  {
    try {
      // Get all student's cart items
      $items = $this->cartItemModel->where("student_id", auth()->id())->findAll();

      if (count($items) === 0) {
        return redirect()->back()->with("error", "Nothing in cart to checkout.");
      }

      $cartItems = [];

      for ($i = 0; $i < count($items); $i++) {
        $cartItems[$i] = [
          "cartItem" => $items[$i],
          "product"  => $items[$i]->product_id ? $this->productModel->find($items[$i]->product_id) : null,
          "variant"  => $items[$i]->variant_id ? $this->variantModel->find($items[$i]->variant_id) : null
        ];
      }

      // * Check if any cart item quantity exceeds the stock
      foreach ($cartItems as $cartItem) {
        if ($cartItem["cartItem"]->is_variant && $cartItem["variant"] && $cartItem["cartItem"]->quantity > $cartItem["variant"]->stock) {
          return redirect()->back()->with("error", "Not enough stocks.");
        } else if (!$cartItem["cartItem"]->is_variant && $cartItem["product"] && $cartItem["cartItem"]->quantity > $cartItem["product"]->stock) {
          return redirect()->back()->with("error", "Not enough stocks.");
        }
      }

      return view('pages/product/checkoutForm.php', ["cartItems" => $cartItems]);
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.");
    }
  }

  /**
   * @desc checkout cart
   * @route POST /cart/checkout/
   * @access private
   */
  public function checkoutCart()
  {
    try {
      // * Get all student's cart items
      $items = $this->cartItemModel->where("student_id", auth()->id())->findAll();

      if (count($items) === 0) {
        return redirect()->back()->with("error", "Nothing in cart to checkout.");
      }

      $cartItems = [];

      // * Populate Cart Items with their corresponding Product
      for ($i = 0; $i < count($items); $i++) {
        $cartItems[$i] = [
          "cartItem" => $items[$i],
          "product"  => $items[$i]->product_id ? $this->productModel->find($items[$i]->product_id) : null,
          "variant"  => $items[$i]->variant_id ? $this->variantModel->find($items[$i]->variant_id) : null
        ];
      }

      // * Validate Data
      $data = $this->request->getPost();
      $data['total'] = 0;
      $data['student_id'] = auth()->id();

      if (!$this->orderModel->validate($data)) {
        return redirect()->back()
          ->with('errors', $this->orderModel->errors())
          ->withInput();
      }

      // * Start Transaction
      $this->db->transException(true)->transStart();

      // * Create Order
      $orderId = $this->orderModel->insert($data);
      $order = $this->getOrderOrError($orderId);

      foreach ($cartItems as $item) {
        $newOrderItem = [];

        if ($item["cartItem"]->is_variant) {
          $itemTotal = $item["cartItem"]->quantity * $item["variant"]->price;

          $newOrderItem = [
            "order_id"    => $orderId,
            "variant_id"  => $item["cartItem"]->variant_id,
            "quantity"    => $item["cartItem"]->quantity,
            "is_variant"  => true,
            "item_total"  => $itemTotal
          ];
        } else {
          $itemTotal = $item["cartItem"]->quantity * $item["product"]->price;

          $newOrderItem = [
            "order_id"    => $orderId,
            "product_id"  => $item["cartItem"]->product_id,
            "quantity"    => $item["cartItem"]->quantity,
            "is_variant"  => false,
            "item_total"  => $itemTotal
          ];
        }


        // * Create Order Item
        $isSuccess = $this->orderItemModel->insert($newOrderItem);

        if (!$isSuccess) {
          throw new DatabaseException("Error creating new order item.");
        }

        // * Update Order total
        $order->total += $itemTotal;
      }

      // * Save updated order
      $this->orderModel->save($order);

      // * Clear student's cart
      $this->cartItemModel->where("student_id", $order->student_id)->delete();

      if ($data["payment_method"] === "online") {
        $res = $this->getCheckoutSessionOrError($cartItems, auth()->user());

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
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with('devErr', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with('devErr', $e->getMessage());
    } catch (DatabaseException $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.")->with('devErr', $e->getMessage());
    }
  }

  private function getStudentOrError($studentId)
  {
    $student = $this->studentModel->findById($studentId);

    if ($student === null) {
      throw new \LogicException("Student not found");
    }

    return $student;
  }

  private function getCartItemOrError($cartItemId)
  {
    $cartItem = $this->cartItemModel->find($cartItemId);

    if ($cartItem === null) {
      throw new \LogicException("Cart Item not found");
    }

    return $cartItem;
  }

  private function getProductOrError($productId)
  {
    $product = $this->productModel->find($productId);

    if ($product === null) {
      throw new \LogicException("Product not found");
    }

    return $product;
  }

  private function getVariantOrError($variantId)
  {
    $variant = $this->variantModel->find($variantId);

    if ($variant === null) {
      throw new \LogicException("Variant not found");
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

  private function getCheckoutSessionOrError($cartItems, $student)
  {
    $lineItems = [];

    // * Map cart items as line item
    foreach ($cartItems as $item) {
      $lineItem = [];

      if ($item["cartItem"]->is_variant) {
        $variantProduct = $this->getProductOrError($item["variant"]->product_id);

        $lineItem = [
          'currency'    => 'PHP',
          'amount'      => round($item["variant"]->price * 100, 0), // round off
          'description' => $variantProduct->description,
          'name'        => $variantProduct->product_name . "[" . $variantProduct->variation_name . ": " . $item["variant"]->option_name . "]",
          'quantity'    => (int)$item["cartItem"]->quantity
        ];
      } else {
        $lineItem = [
          'currency'    => 'PHP',
          'amount'      => round($item["product"]->price * 100, 0), // round off
          'description' => $item["product"]->description,
          'name'        => $item["product"]->product_name,
          'quantity'    => (int)$item["cartItem"]->quantity
        ];
      }

      array_push($lineItems, $lineItem);
    }

    $data = [
      'data' => [
        'attributes' => [
          'billing' => [
            'name'  => $student->full_name,
            'email' => $student->email
          ],
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
      return throw new \LogicException("Error, unable to create checkout session.");
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
}
