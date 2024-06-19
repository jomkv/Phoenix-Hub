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

  protected $allowedFields = ['student_id', 'status', 'total', 'payment_method', 'payment_reference', 'is_paid', 'pickup_date', 'pickup_time'];
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
    'student_id'                      => 'required',
    'total'                           => 'required',
    'payment_method'                  => 'required',
    'pickup_date'                     => 'required',
    'pickup_time'                     => 'required',
  ];

  protected $validationMessages   = [
    'student_id' => [
      'required'    => 'Student ID not found, kindly login and try again.',
    ],
    'total' => [
      'required'    => 'Total must be provided',
    ],
    'payment_method' => [
      'required'    => 'Payment Method must be provided',
    ],
    'pickup_date' => [
      'required'    => 'Pickup Date must be provided',
    ],
    'pickup_time' => [
      'required'    => 'Pickup Time must be provided',
    ]
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
