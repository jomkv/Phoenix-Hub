<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\BarterModel;
use App\Models\PaymentModel;
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
    $studentModel = auth()->getProvider();
    $orderModel = new OrderModel();
    $barterModel = new BarterModel();

    $studentCount = count($studentModel->findAll()) - 1; // * -1 to exclude admin
    $pendingOrdersCount = count($orderModel->where("status", "pending")->findAll());
    $deliverCount = count($orderModel->where("status", "confirmed")->findAll());
    $pendingPostsCount = count($barterModel->where("status", "pending")->findAll());

    return view('pages/admin/dashboard', ["studentCount" => $studentCount, "pendingOrderCount" => $pendingOrdersCount, 'deliverCount' => $deliverCount, "pendingPostCount" => $pendingPostsCount]);
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
   * @desc Admin confirmed orders menu
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
   * @desc Admin received orders menu
   * @route GET /admin/received
   * @access private
   */
  public function viewReceivedOrders(): string
  {
    $model = new OrderModel();

    $confirmedOrders = $model->where("status", "received")->findAll();

    return view('pages/admin/receivedOrders', ["orders" => $confirmedOrders]);
  }

  /**
   * @desc Admin cancelled orders menu
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
    $orderModel = new OrderModel();
    $orgModel = new OrganizationModel();

    // Get all paid orders and group them by month based on the pickup date
    $paidOrders = $orderModel
      ->select('SUM(total) as total, MONTH(pickup_date) as month')
      ->where('is_paid', '1')
      ->groupBy('month')
      ->findAll();

    // Initialize an array to hold the monthly earnings data
    $monthlyEarnings = array_fill(1, 12, 0); // 12 months initialized to 0

    // Populate the monthly earnings array with data from the database
    foreach ($paidOrders as $order) {
      $monthlyEarnings[(int)$order->month] = (float)$order->total;
    }

    // Fetch order count grouped by organization
    $ordersByOrg = $this->getOrdersByOrganization();

    $orgLabels = [];
    $orgData = [];
    foreach ($ordersByOrg as $order) {
      $orgLabels[] = $order['organization_name'];
      $orgData[] = $order['order_count'];
    }

    return view('pages/admin/reports', [
      'monthlyEarnings' => $monthlyEarnings, 'orgLabels' => $orgLabels,
      'orgData' => $orgData
    ]);
  }

  public function getOrdersByOrganization()
  {
    $db = \Config\Database::connect();

    // Join the necessary tables and group by organization to get the count of orders
    $query = $db->table('order_items')
      ->select('organizations.name as organization_name, COUNT(order_items.order_item_id) as order_count')
      ->join('products', 'products.product_id = order_items.product_id', 'left')
      ->join('variations', 'variations.variation_id = order_items.variant_id', 'left')
      ->join('products as variant_products', 'variant_products.product_id = variations.product_id', 'left')
      ->join('organizations', 'organizations.organization_id = products.organization_id OR organizations.organization_id = variant_products.organization_id', 'left')
      ->groupBy('organizations.organization_id')
      ->get();

    return $query->getResultArray();
  }

  /**
   * @desc Admin payment history menu
   * @route GET /admin/history
   * @access private
   */
  public function viewHistory(): string
  {
    $model = new PaymentModel();

    $payments = $model->find();

    return view('pages/admin/history', ["payments" => $payments]);
  }

  /**
   * @desc Admin pending barter posts menu
   * @route GET /admin/barter
   * @access private
   */
  public function viewBarter()
  {
    try {
      $model = new BarterModel();

      $pendingPosts = $model->where("status", "pending")->findAll();

      // * Populate posts alongside their poster (student)
      $payload = [];
      foreach ($pendingPosts as $post) {
        $student = $this->getStudentOrError($post->student_id);

        array_push($payload, [
          "post"    => $post,
          "student" => $student
        ]);
      }

      return view('pages/admin/barterManage', ["payload" => $payload]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing admin products menu: ' . $e->getMessage());
      return redirect()->to('/admin')->with('error', 'An error occurred. Please try again later.')->with('devErr', $e->getMessage());
    } catch (\LogicException $e) {
      return redirect()->to('/admin')->with('error', 'An error occurred. Please try again later.')->with('devErr', $e->getMessage());
    }
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

  public function getStudentOrError($studentId)
  {
    $model = auth()->getProvider();

    $student = $model->find($studentId);

    if ($student === null) {
      throw new \LogicException("Student not found.");
    }

    return $student;
  }
}
