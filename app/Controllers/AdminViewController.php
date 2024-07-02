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
      $rawProducts = $productModel->findAll();

      $products = [];

      $filter = $this->request->getVar("filter");

      // * If filter is given, is a number, and is a valid organization ID
      if ($filter !== null && is_numeric($filter) && $orgModel->find($filter)) {
        $rawProducts = $productModel->where("organization_id", $filter)->findAll();
      } else {
        $rawProducts = $productModel->findAll();
      }

      foreach ($rawProducts as $product) {
        try {
          $productOrg = $this->getOrganizationOrError($product->organization_id);

          $product->organization_name = $productOrg->name;
          array_push($products, $product);
        } catch (\LogicException $e) {
          // do nothing
        }
      }

      //dd($products);

      // If no orgs found
      if (empty($orgs)) {
        $products = [];
      }

      return view('pages/admin/products', ['products' => $products, 'organizations' => $orgs, 'filter' => $filter]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing admin products menu: ' . $e->getMessage());
      return redirect()->to('/admin')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Admin pending orders menu
   * @route GET /admin/pending
   * @access private
   */
  public function viewPendingOrders(): string
  {
    $model = new OrderModel();

    $pendingOrders = $model->where("status", "pending")->findAll();

    return view('pages/admin/pendingOrders', ["orders" => $pendingOrders]);
  }

  /**
   * @desc Admin pending orders menu
   * @route GET /admin/confirmed
   * @access private
   */
  public function viewConfirmedOrders(): string
  {
    $model = new OrderModel();

    $confirmedOrders = $model->where("status", "confirmed")->findAll();

    return view('pages/admin/confirmedOrders', ["orders" => $confirmedOrders]);
  }

  /**
   * @desc Admin pending orders menu
   * @route GET /admin/cancelled
   * @access private
   */
  public function viewCancelledOrders(): string
  {
    $model = new OrderModel();

    $cancelledOrders = $model->where("status", "cancelled")->findAll();

    return view('pages/admin/cancelledOrders', ["orders" => $cancelledOrders]);
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
  public function viewBarter(): string
  {
    return view('pages/admin/barterManage');
  }

  public function getOrganizationOrError($orgId)
  {
    $model = new OrganizationModel();

    $org = $model->find($orgId);

    if ($org === null) {
      throw new \LogicException("Organization not found.");
    }

    return $org;
  }
}
