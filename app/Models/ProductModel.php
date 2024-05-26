<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
  protected $table = 'products';
  protected $primaryKey = 'product_id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['product_name', 'description', 'price', 'stock', 'organization_id', 'image_urls'];
  // protected bool $updateOnlyChanged = true;

  protected bool $allowEmptyInserts = false;

  // * Dates
  protected $useTimestamps = false;
  protected $dateFormat = 'datetime';
  // protected $createdField  = 'created_at';
  // protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  // * Validation

  protected $validationRules      = [
    'product_name'      => 'required|max_length[255]',
    'description'       => 'required|max_length[65530]',
    'price'             => 'required|numeric|greater_than[0]',
    'stock'             => 'required|numeric',
    'organization_id'   => 'required',
    'image_urls'        => 'max_length[65530]'
  ];

  protected $validationMessages   = [
    'product_name' => [
      'required'    => 'Product Name must be provided',
      'max_length'  => 'Product Name too long'
    ],
    'description' => [
      'required'    => 'Description must be provided',
      'max_length'  => 'Description too long'
    ],
    'price' => [
      'required'      => 'Product Price must be provided',
      'greater_than'  => 'Product Price cannot be zero',
      'numberic'      => 'Product Price must be a valid number'
    ],
    'stock' => [
      'required'    => 'Product Stock must be provided',
      'numberic'    => 'Product Stuck must be a valid number'
    ],
    'organization_id' => [
      'required'    => 'Organization ID must be provided',
    ],
    'image_urls' => [
      'max_length'  => 'Image URLs exceeded limit.',
    ],
  ];
  // protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  // * Callbacks
  // protected $allowCallbacks = true;
  // protected $beforeInsert   = [];
  // protected $afterInsert    = [];
  // protected $beforeUpdate   = [];
  // protected $afterUpdate    = [];
  // protected $beforeFind     = [];
  // protected $afterFind      = [];
  // protected $beforeDelete   = [];
  // protected $afterDelete    = [];
}
