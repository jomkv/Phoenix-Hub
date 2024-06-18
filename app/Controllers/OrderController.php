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
    $email->setSubject("Phoenix Hub Order Confirmed");
    $email->setMessage("" .
      "<h3>Hello " . $student->full_name . ", this is to notify you that your Phoenix Hub Order has been confirmed.</h3>" .
      "<h4>Please prepare your payment of ₱" . $order->total . " to be given once picked up at CvSU Silang's Gymnasium at the date and time of " . $order->pickup_date . " " . $order->pickup_time  . "</h4>" .
      "");

    $email->send();
  }

  private function orderCancelEmail($studentId, $orderId)
  {
    $order =  $order = $this->orderModel->find($orderId);
    $student = $this->studentModel->findById($studentId);

    $email = \Config\Services::email();

    $email->setTo($student->getEmail());
    $email->setSubject("Phoenix Hub Order Cancelled");
    $email->setMessage("" .
      "<h3>Hello " . $student->full_name . ", this is to notify you that your Phoenix Hub Order has been cancelled.</h3>" .
      "<h4>If you have any concerns or inquiry please send us an email at phoenixhubsilang@gmail.com</h4>" .
      "");

    $email->send();
  }
}
