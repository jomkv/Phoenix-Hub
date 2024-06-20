<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
  protected $table = 'products';
  protected $primaryKey = 'product_id';

  protected $useAutoIncrement = true;

  protected $returnType     = \App\Entities\Product::class;
  protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['product_id', 'product_name', 'description', 'price', 'stock', 'organization_id', 'images'];
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
    'product_id'        => 'permit_empty',
    'product_name'      => 'required|max_length[255]',
    'description'       => 'required|max_length[65530]',
    'price'             => 'required|numeric|greater_than[0]',
    'stock'             => 'required|numeric',
    'organization_id'   => 'required',
    'images'            => 'required_without[product_id]',
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
      'greater_than'  => 'Product Price must be greater than 0',
      'numeric'      => 'Product Price must be a valid number'
    ],
    'stock' => [
      'required'    => 'Product Stock must be provided',
      'numeric'    => 'Product Stuck must be a valid number'
    ],
    'organization_id' => [
      'required'    => 'Organization ID must be provided',
    ],
    'images' => [
      'required_without'  => 'Product Image(s) must be provided',
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
