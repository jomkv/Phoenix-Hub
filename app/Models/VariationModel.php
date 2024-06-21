<?php

namespace App\Models;

use CodeIgniter\Model;

class VariationModel extends Model
{
  protected $table = 'variations';
  protected $primaryKey = 'variation_id';

  protected $useAutoIncrement = true;

  protected $returnType     = \App\Entities\Variation::class;
  protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['product_id', 'option_name', 'price', 'stock'];
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
    'product_id'        => 'required',
    'option_name'       => 'required|max_length[255]',
    'price'             => 'required|numeric|greater_than[0]',
    'stock'             => 'required|numeric',
  ];

  protected $validationMessages   = [
    'product_id' => [
      'required'    => 'Product ID must be provided'
    ],
    'option_name' => [
      'required'    => 'Option Name must be provided',
      'max_length'  => 'Option Name too long'
    ],
    'price' => [
      'required'      => 'Option Price must be provided',
      'greater_than'  => 'Option Price must be greater than 0',
      'numberic'      => 'Option Price must be a valid number'
    ],
    'stock' => [
      'required'    => 'Option Stock must be provided',
      'numeric'     => 'Option Stuck must be a valid number'
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
