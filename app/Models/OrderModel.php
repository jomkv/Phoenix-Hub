<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
  protected $table = 'orders';
  protected $primaryKey = 'order_id';

  protected $useAutoIncrement = true;

  protected $returnType     = \App\Entities\Order::class;
  protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['student_id', 'organization_id', 'status', 'total', 'payment_method', 'payment_reference', 'is_paid', 'pickup_date'];
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
    'student_id'                      => 'required',
    'organization_id'                 => 'required',
    'status'                          => '',
    'total'                           => '',
    'payment_method'                  => 'required',
    'payment_reference'               => '',
    'is_paid'                         => '',
    'pickup_date'                     => 'required'
  ];

  protected $validationMessages   = [
    'student_id' => [
      'required'    => 'student_id must be provided',
    ],
    'organization_id' => [
      'required'    => 'organization_id must be provided',
    ],
    'payment_method' => [
      'required'    => 'payment_method must be provided',
    ],
    'pickup_date' => [
      'required'    => 'pickup_date must be provided',
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
