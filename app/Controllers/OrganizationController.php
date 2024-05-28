<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\ProductModel;
use CodeIgniter\Files\File;
use Exception;

class OrganizationController extends BaseController
{
  protected $helpers = ['form'];

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
    $validationRule = [
      'upload' => [
        'label' => 'Image File',
        'rules' => [
          'uploaded[upload]',
          'is_image[upload]',
          'mime_in[upload, image/jpg,image/jpeg,image/png,image/webp]',
          'max_size[upload,51200]', // 50 mb limit, converted to kb
        ],
      ],
    ];

    // Validate Image
    if (!$this->validateData([], $validationRule)) {
      return redirect()->to('/admin/organization/new')->with('error', ['errors' => $this->validator->getErrors()]);
    }

    $img = $this->request->getFile('upload');

    // Check if image has been tampered with
    if ($img->hasMoved()) {
      return redirect()->to('/admin/organization/new')->with('error', ['errors' => 'Error occurred, unable to process image']);
    }

    // Generate random file name, and upload image to writable/uploads/
    $imgName = $img->getRandomName();
    $img->move(ROOTPATH . 'public/organizationLogos', $imgName);

    $model = new OrganizationModel();
    $data = $this->request->getPost();
    $data['logo_file_name'] = $imgName;

    // Validate all form data
    if (!$model->validate($data)) {
      return redirect()->to('/admin/organization/new')->with('error', ['errors' => $model->errors()]);
    }

    $isSuccess = $model->insert($data, false);

    if (!$isSuccess) {
      return redirect()->to('/admin/organization/new')->with('error', ['errors' => 'Error occurred, unable to create new organization']);
    }

    return redirect()->to('/admin/organization/')->with('info', 'Organization successfully created');

    // if ($imageFile = $this->request->getFiles()) {
    //   foreach ($imageFile['images'] as $img) {
    //     if ($img->isValid() && !$img->hasMoved()) {
    //       $imgName = $img->getRandomName();
    //       $img->move(WRITEPATH . 'uploads', $imgName);
    //     } else {
    //       // handle error
    //     }
    //   }
    // }
  }
}
