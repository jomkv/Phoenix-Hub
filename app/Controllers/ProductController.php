<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\ProductModel;
use Exception;

class ProductController extends BaseController
{
  /**
   * @desc Returns a view to create new product form
   * @route GET /admin/product/new
   * @access private
   */
  public function viewCreateProduct()
  {
    try {
      $orgModel = new OrganizationModel();

      $orgs = $orgModel->findAll();

      // If no orgs found
      if (empty($orgs)) {
        return redirect()->to('/admin/organization/new')->with('info', 'There must be an Organization before creating a product.');
      }

      return view('pages/admin/createProduct', ['organizations' => $orgs]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing create product: ' . $e->getMessage());
      return redirect()->to('/admin')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Get product info
   * @route GET /admin/product/all
   * @access private
   */
  public function getAllProducts()
  {
    try {
      $productModel = new ProductModel();

      $products = $productModel->findAll();

      if (!$products) {
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Unable to get products']);
      }

      return $this->response->setStatusCode(200)->setJSON($products);
    } catch (\Exception $e) {
      log_message('error', 'Error fetching products: ' . $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['message' => 'Error occurred']);
    }
  }

  /**
   * @desc Get product info
   * @route GET /admin/product/:productId
   * @access private
   */
  public function getProduct($productId)
  {
    try {
      $productModel = new ProductModel();

      $product = $productModel->find($productId);

      if (!$product) {
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Unable to get product']);
      }

      return $this->response->setStatusCode(200)->setJSON($product);
    } catch (\Exception $e) {
      log_message('error', 'Error finding product: ' . $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['message' => 'Error occurred']);
    }
  }

  /**
   * @desc Creates a new product
   * @route POST /admin/product/new
   * @access private
   */
  public function createProduct()
  {
    try {
      $orgModel = new OrganizationModel();
      $productModel = new ProductModel();

      $data = $this->request->getPost();

      // * If data does not pass validation
      if (!$productModel->validate($data)) {
        return redirect()->to('/admin/product/new')->with('error', ['errors' => $productModel->errors()]);
      };

      // * Check if organization_id exists
      $orgExists = $orgModel->find($data['organization_id']);

      if (!$orgExists) {
        return redirect()->to('/admin/product/new')->with('error', ['errors' => "Invalid organization_id, organization not found."]);
      }

      // * Create new product
      $isSuccess = $productModel->insert($data, false);

      if (!$isSuccess) {
        return redirect()->to('/admin/product/new')->with('error', ['errors' => 'Error occurred, unable to create new product']);
      }

      return redirect()->to('/admin/product')->with('info', 'Product successfully created');
    } catch (\Exception $e) {
      log_message('error', 'Error creating organization: ' . $e->getMessage());
      return redirect()->to('/admin/product/new')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Edit product
   * @route PUT /admin/product/:productId
   * @access private
   */
  public function editProduct($productId)
  {
    try {
      $productModel = new ProductModel();

      $data = $this->request->getRawInput();

      // * If data does not pass validation
      if (!$productModel->validate($data)) {
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Error occurred, unable to edit product', 'errors' => $productModel->errors()]);
      };

      // * Check if organization_id exists
      // $orgExists = $orgModel->find($data['organization_id']);

      // if (!$orgExists) {
      //   return redirect()->to('/admin/product/new')->with('error', ['errors' => "Invalid organization_id, organization not found."]);
      // }

      // * Create new product
      $isSuccess = $productModel->update($productId, $data);

      if (!$isSuccess) {
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Error occurred, unable to edit product']);
      }

      return $this->response->setStatusCode(200)->setJSON(['message' => 'Product Edit successful']);
    } catch (\Exception $e) {
      log_message('error', 'Error creating organization: ' . $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['message' => 'An error occurred, unable to edit product']);
    }
  }

  /**
   * @desc Delete product
   * @route DELETE /admin/product/:productId
   * @access private
   */
  public function deleteProduct($productId)
  {
    try {
      $productModel = new ProductModel();

      $isSuccess = $productModel->delete($productId);

      if (!$isSuccess) {
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Unable to delete product']);
      }

      return $this->response->setStatusCode(200)->setJSON(['message' => 'Product successfuly deleted']);
    } catch (\Exception $e) {
      log_message('error', 'Error deleting product: ' . $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['message' => 'Error occurred']);
    }
  }
}
