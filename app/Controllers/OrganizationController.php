<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\ProductModel;
use App\Entities\Organization;
use CodeIgniter\Exceptions\PageNotFoundException;

class OrganizationController extends BaseController
{
  protected $helpers = ['form', 'upload'];

  private OrganizationModel $model;

  public function __construct()
  {
    $this->model = new OrganizationModel();
  }

  /**
   * @desc Returns a view to create new organization form
   * @route GET /admin/organization/new
   * @access private
   */
  public function viewCreateOrg(): string
  {
    return view('pages/admin/createOrganization');
  }

  /**
   * @desc Returns a view to edit organization form
   * @route GET /admin/organization/:orgId
   * @access private
   */
  public function viewEditOrg($orgId)
  {
    try {
      $org = $this->model->find($orgId);

      if (!$org) {
        return redirect()->to('/admin/organization')->with('error', "Organization not found.");
      }

      return view('pages/admin/editOrganization', ["organization" => $org]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing edit organization: ' . $e->getMessage());
      return redirect()->to('/')->with('error', 'An error occurred. Please try again later.');
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
      $productModel = new ProductModel();

      $org = $orgModel->find($orgId);

      if (!$org) {
        return redirect()->to('/')->with('error', 'An error occurred. Organization not found.');
      }

      $products = $productModel->where('organization_id', $orgId)->findAll();

      return view('pages/organization/productsOffered', ['organization' => $org, 'products' => $products]);
    } catch (\Exception $e) {
      log_message('error', 'Error viewing organization products: ' . $e->getMessage());
      return redirect()->to('/')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Creates a new organization
   * @route POST /admin/organization/new
   * @access private
   */
  public function createOrg()
  {
    try {
      $data = $this->request->getPost();

      // Validate form data, excluding image
      if (!$this->model->validate($data)) {
        return redirect()->back()
          ->with('errors', $this->model->errors())
          ->withInput();
      }

      $validationRule = [
        'upload' => [
          'label' => 'Image File',
          'rules' => [
            'uploaded[upload]',
            'is_image[upload]',
            'mime_in[upload, image/jpg,image/jpeg,image/png,image/webp]',
            'max_size[upload,10200]', // 10 mb limit, converted to kb
          ],
        ],
      ];

      // Validate Image
      if (!$this->validateData([], $validationRule)) {
        return redirect()->back()
          ->with('errors', $this->validator->getErrors())
          ->withInput();
      }

      $img = $this->request->getFile('upload');

      // Check if image has been tampered with
      if ($img->hasMoved()) {
        return redirect()->back()
          ->with('error', 'Error occurred, unable to process image')
          ->withInput();
      }

      // Generate random file name, and upload image to writable/uploads/
      $imgName = $img->getFilename();
      $img->move(ROOTPATH . 'writable\\uploads\\', $imgName);

      $data['logo'] = upload_image(ROOTPATH . 'writable\\uploads\\' . $imgName);

      // Delete uploaded org image
      unlink(ROOTPATH . 'writable\\uploads\\' . $imgName);

      $newOrganization = new Organization($data);
      $isSuccess = $this->model->insert($newOrganization);

      if ($isSuccess) {
        return redirect()->to('/admin/organization')->with('message', 'Organization successfully created');
      } else {
        return redirect()->to('/admin/organization')->with('error', 'Server error, unable to create new organization');
      }
    } catch (\Exception $e) {
      return redirect()->to('/admin/organization/new')->with('error', 'Server error. Please try again later')->with('stack', $e);
    }
  }

  /**
   * @desc Deletes an organization
   * @route DELETE /admin/organization/:orgId
   * @access private
   */
  public function deleteOrg($orgId)
  {
    try {
      $org = $this->getOrganizationOrError($orgId);

      // Delete uploaded org image
      delete_image(json_decode($org->logo)->public_id);

      $this->model->delete($org->organization_id);

      if ($this->request->hasHeader('x-reload')) {
        $updatedOrgList = $this->model->findAll();
        return view('partials/admin/organizationCards', ["organizations" => $updatedOrgList]);
      }

      return redirect()->to('/admin/organization')->with('message', 'Organization successfully deleted.');
    } catch (\LogicException $e) {
      if ($this->request->hasHeader('x-reload')) {
        return $this->response->setStatusCode(400);
      }

      return redirect()->back()->with('error', $e->getMessage());
    } catch (\Exception $e) {
      if ($this->request->hasHeader('x-reload')) {
        return $this->response->setStatusCode(500);
      }

      return redirect()->to('/admin/organization/new')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Edits an organization
   * @route PUT /admin/organization/:orgId
   * @access private
   */
  public function editOrg($orgId)
  {
    try {
      $org = $this->getOrganizationOrError($orgId);
      $data = $this->request->getPost();
      $data["organization_id"] = $orgId;

      // Validate form data, excluding image
      if (!$this->model->validate($data)) {
        return redirect()->back()
          ->with('errors', $this->model->errors())
          ->withInput();
      }

      $validationRule = [
        'upload' => [
          'label' => 'Image File',
          'rules' => [
            'uploaded[upload]',
            'is_image[upload]',
            'mime_in[upload, image/jpg,image/jpeg,image/png,image/webp]',
            'max_size[upload,10200]', // 10 mb limit, converted to kb
          ],
        ],
      ];

      // Validate Image
      if (!$this->validateData([], $validationRule)) {
        return redirect()->back()
          ->with('errors', $this->validator->getErrors())
          ->withInput();
      }

      $img = $this->request->getFile('upload');

      // Check if image has been tampered with
      if ($img->hasMoved()) {
        return redirect()->back()
          ->with('error', 'Error occurred, unable to process image')
          ->withInput();
      }

      // Delete uploaded org image
      delete_image(json_decode($org->logo)->public_id);

      // Generate random file name, and upload image to writable/uploads/
      $imgName = $img->getFilename();
      $img->move(ROOTPATH . 'writable\\uploads\\', $imgName);

      $data['logo'] = upload_image(ROOTPATH . 'writable\\uploads\\' . $imgName);

      // Delete uploaded org image
      unlink(ROOTPATH . 'writable\\uploads\\' . $imgName);

      $isSuccess = $this->model->update($orgId, $data);

      if ($isSuccess) {
        return redirect()->to('/admin/organization')->with('message', 'Organization successfully edited');
      } else {
        return redirect()->to('/admin/organization')->with('error', 'Server error, unable to edit new organization');
      }
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    } catch (\Exception $e) {
      log_message('error', 'Error deleting organization: ' . $e->getMessage());
      return redirect()->to('/admin/organization/new')->with('error', 'An error occurred. Please try again later.');
    }
  }

  private function getOrganizationOrError($id)
  {
    $organization = $this->model->find($id);

    if ($organization === null) {
      throw new \LogicException("Organization not found");
    }

    return $organization;
  }
}
