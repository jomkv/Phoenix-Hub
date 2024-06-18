<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use CodeIgniter\Shield\Entities\User;

class AdminViewController extends BaseController
{
  /**
   * @desc admin login page
   * @route GET /admin/login
   * @access public
   */
  public function viewLogin()
  {
    if (auth()->loggedIn()) {
      return redirect()->to('/admin');
    }

    return view('pages/admin/login');
  }

  /**
   * @desc admin signup page
   * @route GET /admin/signup
   * @access public
   */
  public function viewSignup(): string
  {
    return view('pages/admin/signup');
  }

  /**
   * @desc Admin dashboard menu
   * @route GET /admin
   * @access private
   */
  public function viewDashboard(): string
  {
    return view('pages/admin/dashboard');
  }

  /**
   * @desc Admin organization menu
   * @route GET /admin/organization
   * @access private
   */
  public function viewOrganizations()
  {
    try {
      $orgModel = new OrganizationModel();

      $orgs = $orgModel->findAll();

      return view('pages/admin/organizations', ['organizations' => $orgs]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing admin organization menu: ' . $e->getMessage());
      return redirect()->to('/admin')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Admin product menu
   * @route GET /admin/product
   * @access private
   */
  public function viewProducts()
  {
    try {
      $productModel = new ProductModel();
      $orgModel = new OrganizationModel();

      $orgs = $orgModel->findAll();
      $products = $productModel->findAll();

      //dd($products);

      // If no orgs found
      if (empty($orgs)) {
        $products = [];
      }

      return view('pages/admin/products', ['products' => $products, 'organizations' => $orgs]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing admin products menu: ' . $e->getMessage());
      return redirect()->to('/admin')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Admin orders menu
   * @route GET /admin/orders
   * @access private
   */
  public function viewPending(): string
  {
    $model = new OrderModel();

    $pending = $model->where("status", "pending")->findAll();
    $confirmed = $model->where("status", "confirmed")->findAll();
    $all = [...$pending, ...$confirmed];
    $filter = "none";

    $orders = [];

    if ($this->request->getMethod() === "POST") {
      $data = $this->request->getPost();

      if ($data["filter"] === "pending") {
        $filter = "pending";
        $orders = $pending;
      } else if ($data["filter"] === "confirmed") {
        $filter = "confirmed";
        $orders = $confirmed;
      } else {
        $orders = $all;
      }
    } else {
      $orders = $all;
    }

    return view('pages/admin/pendingPurchases', ["orders" => $orders, "filter" => $filter]);
  }

  /**
   * @desc Admin reports menu
   * @route GET /admin/reports
   * @access private
   */
  public function viewReports(): string
  {
    return view('pages/admin/reports');
  }

  /**
   * @desc Admin history menu
   * @route GET /admin/history
   * @access private
   */
  public function viewHistory(): string
  {
    return view('pages/admin/history');
  }
}
