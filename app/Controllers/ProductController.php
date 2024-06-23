<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;

use App\Models\OrganizationModel;
use App\Models\ProductModel;
use App\Models\VariationModel;

class ProductController extends BaseController
{
  protected $helpers = ['form', 'upload'];
  private ProductModel $model;
  private OrganizationModel $orgModel;
  private VariationModel $variantModel;
  private $db;

  public function __construct()
  {
    $this->model = new ProductModel();
    $this->orgModel = new OrganizationModel();
    $this->variantModel = new VariationModel();
    $this->db = \Config\Database::connect();
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
      $variations = $this->variantModel->where("product_id", $product->product_id)->findAll();

      // dd($product);

      return view('pages/product/productPage', ["product" => $product, "organization" => $organization, "variants" => $variations]);
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
      $orgs = $this->orgModel->findAll();

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
      $orgs = $this->orgModel->findAll();

      // If no orgs found
      if (empty($orgs)) {
        return redirect()->to('/admin/product')
          ->with('info', 'There must be an Organization before editing a product.');
      }

      $variations = $this->variantModel->where("product_id", $product->product_id)->findAll();

      return view('pages/admin/editProduct', ['organizations' => $orgs, 'product' => $product, 'variations' => $variations]);
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
      $variantOptions = [];
      $errors = [];
      $isDataValid = true;

      //* Validate data
      if (!$this->model->validate($data)) {
        $errors = [...$this->model->errors()];
        $isDataValid = false;
      }

      // * Validate Variations and Options if applicable
      if (isset($data["has_variations"])) {
        try {
          $variantOptions = $this->getOptionsOrError($data);
          $data["has_variations"] = true;
        } catch (\Exception $e) {
          $errors = [...$errors, "options" => $e->getMessage()];
          $isDataValid = false;
        }
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
        $errors = [...$errors, $this->validator->getErrors()];
        $isDataValid = false;
      }

      if (count($rawImages) > 4) {
        $errors = [...$errors, "images" => "Maximum of 4 Images"];
        $isDataValid = false;
      }

      $images = [];

      // * Do a first pass for validation, before uploading anything to cloudinary
      foreach ($rawImages as $image) {
        // * Check Image Size
        if ($image->getSizeByUnit('mb') >= 10) {
          $errors = [...$errors, "images" => "Each image size must be below 10mb"];
          $isDataValid = false;
          break;
        }
      }

      if (!$isDataValid) {
        return redirect()->back()
          ->with('errors', $this->validator->getErrors())
          ->withInput();
      }

      // * Start transaction
      $this->db->transException(true)->transStart();

      // * Upload image logic
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

      // * Create product
      $data['images'] = json_encode($images);
      $productId = $this->model->insert($data);

      if (!$productId) {
        throw new \CodeIgniter\Database\Exceptions\DatabaseException("Unable to create new product.");
      }

      // * Create variation options
      foreach ($variantOptions as $option) {
        $newOption = [
          "product_id"  => $productId,
          "option_name" => $option["name"],
          "price"       => $option["price"],
          "stock"       => $option["stock"],
        ];

        $this->variantModel->insert($newOption);
      }

      // * Complete Transaction
      $this->db->transComplete();

      return redirect()->to("/admin/product")->with("message", "New product created");
    } catch (\Exception $e) {
      return redirect()->to("/admin/product")->with('error', 'An error occurred. Please try again later.');
    } catch (DatabaseException $e) {
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
      $variantOptions = [];
      $data["product_id"] = $productId;
      $rawImages = $this->request->getFileMultiple('fileuploads');
      $hasImages = false;
      $hasVariants = false;

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

      // * Validate Variations and Options if applicable
      if (isset($data["has_variations"])) {
        try {
          $hasVariants = true;
          $variantOptions = $this->getOptionsWithIdOrError($data);
          $data["has_variations"] = true;
          $data["stock"] = null;
          $data["price"] = null;
        } catch (\Exception $e) {
          return redirect()->back()
            ->with('errors', [$e->getMessage()])
            ->withInput();
        }
      }
      else {
        $data["has_variations"] = false;
        $data["variation_name"] = null;
      }

      // * Validate variant options if empty
      if($hasVariants && count($variantOptions) <= 0) {
        return redirect()->back()
        ->with("errors", ["Variation Option cannot be 0"])
        ->withInput();
      }

      $idsToDelete = $this->getDeletedVariations($variantOptions, $productId);

      // * Start transaction
      $this->db->transException(true)->transStart();

      // * If form data has image(s)
      if ($rawImages[0]->isValid()) {
        $hasImages = true;

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

      // * Update Variation Options
      foreach ($variantOptions as $option) {
        // * If new variation, create new
        if ($option["id"] === "null") {
          $this->variantModel->insert([
            "product_id"    => $product->product_id,
            "option_name"   => $option["name"],
            "price"         => $option["price"],
            "stock"         => $option["stock"]
          ]);
        } // * Else, edit existing variation
        else {
          $this->variantModel->update($option["id"], [
            "option_name"   => $option["name"],
            "price"         => $option["price"],
            "stock"         => $option["stock"],
          ]);
        }
      }

      // * Delete variations that are not in use
      if($hasVariants) {
        foreach($idsToDelete as $idToDelete) {
          $this->variantModel->delete($idToDelete);
        }
      }
      else {
        $this->variantModel->where("product_id", $productId)->delete();
      }
      

      $this->model->update($productId, $data);

       // * Complete Transaction
       $this->db->transComplete();

       // * Delete residual assets if product image was changed
       if ($hasImages) {
        foreach (json_decode($product->images) as $image) {
          delete_image($image->public_id);
        }
       }

      return redirect()->to('/admin/product')->with('message', 'Product edited');
    } catch (\LogicException $e) {
      return redirect()->to('/admin/product')->with('error', 'Product not found');
    } catch (\Exception $e) {
      return redirect()->to('/admin/product')->with('error', 'An error occurred. Please try again later.');
    } catch (DatabaseException $e) {
      return redirect()->to("/admin/product")->with('error', 'An error occurred. Please try again later.');
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

  private function getOptionsOrError($data)
  {
    $variantOptions = [];

    for ($i = 1; $i <= (int) $data["option_count_hidden"]; $i++) {
      $nameKey = "option_name_" . $i;
      $priceKey = "option_price_" . $i;
      $stockKey = "option_stock_" . $i;

      $name = $data[$nameKey];
      $price = $data[$priceKey];
      $stock = $data[$stockKey];

      if (empty($name) || empty($price) || empty($stock)) {
        return throw new \Exception("Incomplete option input, please try again.");
      }

      if (!is_numeric($price) || !is_numeric($stock)) {
        return throw new \Exception("Invalid option input, price and/or stock must be numeric.");
      }

      $payload = [
        "name"    => $name,
        "price"   => $price,
        "stock"   => $stock
      ];

      array_push($variantOptions, $payload);
    }

    return $variantOptions;
  }

  private function getOptionsWithIdOrError($data)
  {
    $variantOptions = [];

    for ($i = 1; $i <= (int) $data["option_count_hidden"]; $i++) {
      $idKey = "option_id_" . $i;
      $nameKey = "option_name_" . $i;
      $priceKey = "option_price_" . $i;
      $stockKey = "option_stock_" . $i;

      $id = $data[$idKey];
      $name = $data[$nameKey];
      $price = $data[$priceKey];
      $stock = $data[$stockKey];

      if (empty($id) || empty($name) || empty($price) || empty($stock)) {
        return throw new \Exception("Incomplete option input, please try again.");
      }

      if (!is_numeric($price) || !is_numeric($stock)) {
        return throw new \Exception("Invalid option input, price and/or stock must be numeric.");
      }

      $payload = [
        "id"      => $id,
        "name"    => $name,
        "price"   => $price,
        "stock"   => $stock
      ];

      array_push($variantOptions, $payload);
    }

    return $variantOptions;
  }

  private function getDeletedVariations($newVariants, $productId) {
    $variations = $this->variantModel->where("product_id", $productId)->findAll();

    $existingVariantIds = [];
    $newVariantIds = [];

    foreach($variations as $variation) {
      array_push($existingVariantIds, $variation->variation_id);
    }

    foreach($newVariants as $newVariant) {
      if($newVariant["id"] !== "null") {
        array_push($newVariantIds, $newVariant["id"]);
      }
    }

    return array_diff($existingVariantIds, $newVariantIds);
  }
}
