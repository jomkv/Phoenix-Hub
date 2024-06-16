<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
  protected $table = 'order_items';
  protected $primaryKey = 'order_item_id';

  protected $useAutoIncrement = true;

  protected $returnType     = \App\Entities\OrderItem::class;
  protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['order_id', 'product_id', 'quantity', 'item_total'];
  // protected bool $updateOnlyChanged = true;

  protected bool $allowEmptyInserts = false;

  // * Dates
  protected $useTimestamps = false;
  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  // * Validation

  protected $validationRules      = [
    'order_id'                   => 'required',
    'product_id'                 => 'required',
    'quantity'                   => 'required',
    'item_total'                 => 'required',
  ];

  protected $validationMessages   = [
    'order_id' => [
      'required'    => 'order_id must be provided',
    ],
    'product_id' => [
      'required'    => 'product_id must be provided',
    ],
    'quantity' => [
      'required'    => 'quantity must be provided',
    ],
    'item_total' => [
      'required'    => 'item_total must be provided',
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
