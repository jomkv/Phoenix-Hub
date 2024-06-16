<?php

namespace App\Controllers;

use App\Models\CartItemModel;
use App\Models\ProductModel;

use App\Entities\CartItem;
use App\Entities\Product;

class CartController extends BaseController
{
  private CartItemModel $cartItemModel;
  private ProductModel $productModel;
  private $studentModel;

  public function __construct()
  {
    $this->productModel = new ProductModel();
    $this->cartItemModel = new CartItemModel();
    $this->studentModel = auth()->getProvider();;
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
   * @route GET /cart/remove/:cartItemId
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
}
