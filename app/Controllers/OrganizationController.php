<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use Exception;

class OrganizationController extends BaseController
{
  /**
   * @desc Returns a view to create new organization form
   * @route GET /organization/new
   * @access public
   */
  public function viewCreateOrg(): string
  {
    return view('pages/organization/createOrganization');
  }

  /**
   * @desc Creates a new organization
   * @route POST /organization/new
   * @access private
   */
  public function createOrg()
  {
    try {
      $model = new OrganizationModel();

      $data = $this->request->getPost();

      // * If data does not pass validation
      if (!$model->validate($data)) {
        return redirect()->to('/organization/new')->with('error', ['errors' => $model->errors()]);
      };

      $isSuccess = $model->insert($data, false);

      if (!$isSuccess) {
        return throw new Exception('Error occurred, unable to create new organization');
      }

      return redirect()->to('/organization/new')->with('info', 'Organization successfully created');
    } catch (\Exception $e) {
      log_message('error', 'Error creating organization: ' . $e->getMessage());
      return redirect()->to('/organization/new')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Returns a view to organization's offered products
   * @route GET /:orgId/products
   * @access public
   */
  public function viewOrgProducts($orgId)
  {
    try {
      $orgModel = new OrganizationModel();

      $org = $orgModel->find($orgId);

      if (!$org) {
        return redirect()->to('/')->with('error', 'An error occurred. Organization not found.');
      }

      return view('pages/organization/products', ['organization' => $org, 'products' => []]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing organization products: ' . $e->getMessage());
      return redirect()->to('/')->with('error', 'An error occurred. Please try again later.');
    }
  }
}