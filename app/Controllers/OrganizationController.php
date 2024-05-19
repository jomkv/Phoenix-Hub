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
   * @desc Returns a view to signup page
   * @route POST /organization/new
   * @access public
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
}
