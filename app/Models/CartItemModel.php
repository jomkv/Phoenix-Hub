<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
  protected $table = 'cart_items';
  protected $primaryKey = 'cart_item_id';

  protected $useAutoIncrement = true;

  protected $returnType     = \App\Entities\CartItem::class;
  //protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['student_id', 'product_id', 'variant_id', 'is_variant', 'quantity'];
  // protected bool $updateOnlyChanged = true;

  protected bool $allowEmptyInserts = false;

  // * Dates
  protected $useTimestamps = false;
  protected $dateFormat = 'datetime';
  // protected $createdField  = 'created_at';
  // protected $updatedField  = 'updated_at';
  // protected $deletedField  = 'deleted_at';

  // * Validation

  protected $validationRules      = [
    'quantity'                        => 'required',
  ];

  protected $validationMessages   = [
    'quantity' => [
      'required'    => 'quantity must be provided',
    ],
  ];
  // protected $skipValidation       = false;
  // protected $cleanValidationRules = true;

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
