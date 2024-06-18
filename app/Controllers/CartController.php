<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;

use App\Models\CartItemModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

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
  private $studentModel;
  private $db;

  public function __construct()
  {
    $this->productModel = new ProductModel();
    $this->cartItemModel = new CartItemModel();
    $this->orderModel = new OrderModel();
    $this->orderItemModel = new OrderItemModel();
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
        $cartItems[$i] = [
          "cartItem" => $items[$i],
          "product"  => $this->getProductOrError($items[$i]->product_id),
        ];
      }

      return view('pages/product/cart.php', ["cartItems" => $cartItems]);
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.");
    }
  }

  /**
   * @desc Adds a product to cart
   * @route GET /cart/add/:productId/:quantity
   * @access private
   */
  public function addToCart($productId, $quantity)
  {
    try {
      $product = $this->getProductOrError($productId);

      if ($quantity > $product->stock) {
        return redirect()->back()->with("error", "Unable to add to cart, not enough stocks.");
      }

      $existingCartItem = $this->cartItemModel
        ->where("student_id", auth()->id())
        ->where("product_id", $productId)
        ->first();

      if ($existingCartItem) {
        if (($existingCartItem->quantity + $quantity) > $product->stock) {
          return redirect()->back()->with("error", "Unable to add to cart, not enough stocks.");
        }
        // Update quantity of existing cart item
        $existingCartItem->quantity += $quantity;

        $isSuccess = $this->cartItemModel->save($existingCartItem);

        if ($isSuccess) {
          return redirect()->back()->with("message", "Item added to cart.");
        } else {
          return redirect()->back()->with("error", "Unable to add item to cart.");
        }
      }

      $newCartItem = new CartItem([
        "student_id" => auth()->id(),
        "product_id" => $productId,
        "quantity"   => $quantity,
      ]);

      // Get all student's cart items
      $isSuccess = $this->cartItemModel->save($newCartItem);

      if ($isSuccess) {
        return redirect()->to("/cart")->with("message", "Item added to cart");
      } else {
        return redirect()->back()->with("error", "Unable to add to cart");
      }
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.");
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
          "product"  => $this->getProductOrError($items[$i]->product_id),
        ];
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
          "product"  => $this->getProductOrError($items[$i]->product_id),
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
        $itemTotal = $item["cartItem"]->quantity * $item["product"]->price;

        $newOrderItem = [
          "order_id"    => $orderId,
          "product_id"  => $item["cartItem"]->product_id,
          "quantity"    => $item["cartItem"]->quantity,
          "item_total"  => $itemTotal
        ];

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
        $res = $this->getCheckoutSessionOrError($cartItems);

        $this->orderModel->update($orderId, [
          "payment_reference" => $res["id"]
        ]);

        // * Complete Transaction
        $this->db->transComplete();

        return redirect()->to($res["url"]);
      } else {
        // * Complete Transaction
        $this->db->transComplete();

        return redirect()->to("/")->with("message", "Order Submitted");
      }
    } catch (\LogicException $e) {
      return redirect()->to("/")->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.");
    } catch (DatabaseException $e) {
      return redirect()->to("/")->with('error', "Error, please try again later.");
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

  private function getOrderOrError($orderId)
  {
    $order = $this->orderModel->find($orderId);

    if ($order === null) {
      throw new \LogicException("Order not found");
    }

    return $order;
  }

  private function getCheckoutSessionOrError($cartItems)
  {
    $lineItems = [];

    // * Map cart items as line item
    foreach ($cartItems as $item) {
      $lineItem = [
        'currency'    => 'PHP',
        'amount'      => round($item["product"]->price * 100, 0), // round off
        'description' => $item["product"]->description,
        'name'        => $item["product"]->product_name,
        'quantity'    => (int)$item["cartItem"]->quantity
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
          'success_url' => url_to('OrderController::success'),
          'cancel_url' => url_to('OrderController::cancel'),
          'description' => 'Payment for Test Product'
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
      return throw new \LogicException("Error, unable to create checkout session.");
    }

    curl_close($curl);
    $responseData = json_decode($response);

    $sessionId = $responseData->data->id ?? null;
    $checkoutUrl = $responseData->data->attributes->checkout_url ?? null;

    // * If session id and checkout url created
    if (!$sessionId || !$checkoutUrl) {
      dd($responseData);
      throw new \LogicException("Error, unable to create checkout session.");
    }

    return [
      "id"        => $sessionId,
      "url"       => $checkoutUrl
    ];
  }
}
