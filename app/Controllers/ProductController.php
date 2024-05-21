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
   * @desc Returns a view to admin's products menu
   * @route GET /admin/product
   * @access private
   */
  public function viewAdminProducts()
  {
    try {
      $productModel = new ProductModel();

      $products = $productModel->findAll();

      // If no orgs found
      if (empty($orgs)) {
        $products = [];
      }

      return view('pages/admin/products', ['products' => $products]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing admin products menu: ' . $e->getMessage());
      return redirect()->to('/admin')->with('error', 'An error occurred. Please try again later.');
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

      return redirect()->to('/admin/product/new')->with('info', 'Product successfully created');
    } catch (\Exception $e) {
      log_message('error', 'Error creating organization: ' . $e->getMessage());
      return redirect()->to('/admin/product/new')->with('error', 'An error occurred. Please try again later.');
    }
  }
}
