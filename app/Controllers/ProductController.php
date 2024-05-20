<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use Exception;

class ProductController extends BaseController
{
  /**
   * @desc Returns a view to create new product form
   * @route GET /admin/product/new
   * @access private
   */
  public function viewCreateProduct(): string
  {
    return view('pages/product/createProduct');
  }

  /**
   * @desc Creates a new product
   * @route POST /admin/product/new
   * @access private
   */
  public function createProduct()
  {
    try {
      // TODO
    } catch (\Exception $e) {
      // TODO
    }
  }
}
