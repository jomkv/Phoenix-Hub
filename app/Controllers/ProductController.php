<?php

namespace App\Controllers;

use App\Models\OrganizationModel;
use App\Models\ProductModel;
use Exception;

class ProductController extends BaseController
{
  protected $helpers = ['form', 'upload'];
  private ProductModel $model;
  private OrganizationModel $orgModel;

  public function __construct()
  {
    $this->model = new ProductModel();
    $this->orgModel = new OrganizationModel();
  }

  /**
   * @desc Returns a view to all products
   * @route GET /product
   * @access private
   */
  public function viewAllProducts()
  {
    $products = $this->model->findAll();

    return view('pages/organization/productsOffered.php', ["products" => $products]);
  }

  /**
   * @desc Returns a view to dedicated product page
   * @route GET /product/:productId
   * @access private
   */
  public function viewProduct($productId)
  {
    try {
      $product = $this->getProductOrError($productId);
      $organization = $this->getOrganizationOrError($product->organization_id);

      // dd($product);

      return view('pages/product/productPage', ["product" => $product, "organization" => $organization]);
    } catch (\LogicException $e) {
      return redirect()->back()->with('error', $e->getMessage());
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error, please try again later');
    }
  }

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
        return redirect()->to('/admin/product')
          ->with('info', 'There must be an Organization before creating a product.');
      }

      return view('pages/admin/createProduct', ['organizations' => $orgs]);
    } catch (\Exception $e) {
      return redirect()->to('/admin/product')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Returns a view to edit product form
   * @route GET /admin/product/:productId
   * @access private
   */
  public function viewEditProduct($productId)
  {
    try {
      $product = $this->getProductOrError($productId);
      $orgModel = new OrganizationModel();

      $orgs = $orgModel->findAll();

      // If no orgs found
      if (empty($orgs)) {
        return redirect()->to('/admin/product')
          ->with('info', 'There must be an Organization before editing a product.');
      }

      return view('pages/admin/editProduct', ['organizations' => $orgs, 'product' => $product]);
    } catch (\LogicException $e) {
      return redirect()->to('/admin/product')->with('error', 'Product not found');
    } catch (\Exception $e) {
      return redirect()->to('/admin/product')->with('error', 'An error occurred. Please try again later.');
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
      $data = $this->request->getPost();

      // Validate data
      if (!$this->model->validate($data)) {
        return redirect()->back()
          ->with('errors', $this->model->errors())
          ->withInput();
      }

      $rawImages = $this->request->getFileMultiple('fileuploads');

      $validationRules = [
        'fileuploads' => [
          'label' => 'Image(s)',
          'rules' => [
            'uploaded[fileuploads]',
            'is_image[fileuploads]',
            'mime_in[fileuploads,image/jpg,image/jpeg,image/png,image/webp]',
          ],
        ],
      ];

      if (!$this->validate($validationRules)) {
        return redirect()->back()
          ->with('errors', $this->validator->getErrors())
          ->withInput();
      }

      if (count($rawImages) > 4) {
        return redirect()->back()
          ->with('errors', ['Maximum of 4 Images'])
          ->withInput();
      }

      $images = [];

      // * Do a first pass for validation, before uploading anything to cloudinary
      foreach ($rawImages as $image) {
        // * Check Image Size
        if ($image->getSizeByUnit('mb') >= 10) {
          return redirect()->back()
            ->with("errors", ["Each image size must be below 10mb"])
            ->withInput();
        }
      }

      foreach ($rawImages as $image) {
        // * Store image at uploads dir
        $newName = $image->getRandomName();
        $image->move(WRITEPATH . 'uploads', $newName);

        // * Upload image to cloudinary
        array_push(
          $images,
          upload_image(WRITEPATH . 'uploads\\' . $newName, false)
        );

        // * Remove image at uploads dir
        unlink(WRITEPATH . 'uploads\\' . $newName);
      }

      $data['images'] = json_encode($images);

      $isSuccess = $this->model->insert($data);

      if ($isSuccess) {
        return redirect()->to("/admin/product")->with("message", "New product created");
      } else {
        return redirect()->to("/admin/product")->with("error", "Server error, unable to create new product");
      }
    } catch (\Exception $e) {
      return redirect()->to("/admin/product")->with('error', 'An error occurred. Please try again later.');
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
      $product = $this->getProductOrError($productId);
      $data = $this->request->getPost();
      $data["product_id"] = $productId;
      $rawImages = $this->request->getFileMultiple('fileuploads');

      if (!$this->model->validate($data)) {
        return redirect()->back()
          ->with('errors', $this->model->errors())
          ->withInput();
      }

      if (count($rawImages) > 4) {
        return redirect()->back()
          ->with('errors', ['Maximum of 4 Images'])
          ->withInput();
      }

      // * If form data has image(s)
      if ($rawImages[0]->isValid()) {

        $validationRules = [
          'fileuploads' => [
            'label' => 'Image(s)',
            'rules' => [
              'uploaded[fileuploads]',
              'is_image[fileuploads]',
              'mime_in[fileuploads,image/jpg,image/jpeg,image/png,image/webp]',
            ],
          ],
        ];

        if (!$this->validate($validationRules)) {
          return redirect()->back()
            ->with('errors', $this->validator->getErrors())
            ->withInput();
        }

        // * Do a first pass for image validation, before uploading anything to cloudinary
        foreach ($rawImages as $image) {

          // * Check Image Size
          if ($image->getSizeByUnit('mb') >= 10) {
            return redirect()->back()
              ->with("errors", ["Each image size must be below 10mb"])
              ->withInput();
          }
        }

        // * Delete product's images from cloudinary
        foreach (json_decode($product->images) as $image) {
          delete_image($image->public_id);
        }

        // * Upload a new set of images
        $images = [];
        foreach ($rawImages as $image) {
          // * Store image at uploads dir
          $newName = $image->getRandomName();
          $image->move(WRITEPATH . 'uploads', $newName);

          // * Upload image to cloudinary
          array_push(
            $images,
            upload_image(WRITEPATH . 'uploads\\' . $newName, false)
          );

          // * Remove image at uploads dir
          unlink(WRITEPATH . 'uploads\\' . $newName);
        }

        $data['images'] = json_encode($images);
      }

      if ($this->model->update($productId, $data)) {
        return redirect()->to('/admin/product')->with('message', 'Product edited');
      } else {
        return redirect()->back()
          ->with('errors', $this->model->errors())
          ->withInput();
      }
    } catch (\LogicException $e) {
      return redirect()->to('/admin/product')->with('error', 'Product not found');
    } catch (\Exception $e) {
      return redirect()->to('/admin/product')->with('error', $e->getMessage());
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
      $product = $this->getProductOrError($productId);

      $images = json_decode($product->images);

      foreach ($images as $image) {
        delete_image($image->public_id);
      }

      $this->model->delete($productId);

      return $this->response->setStatusCode(200)->setJSON(['message' => 'Product successfuly deleted']);
    } catch (\LogicException $e) {
      return $this->response->setStatusCode(400)->setJSON(['message' => 'Product not found']);
    } catch (\Exception $e) {
      log_message('error', 'Error deleting product: ' . $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['message' => 'Error occurred']);
    }
  }

  private function getProductOrError($id)
  {
    $product = $this->model->find($id);

    if ($product === null) {
      throw new \LogicException("Product not found");
    }

    return $product;
  }

  private function getOrganizationOrError($id)
  {
    $org = $this->orgModel->find($id);

    if ($org === null) {
      throw new \LogicException("Product's Organization not found");
    }

    return $org;
  }
}
