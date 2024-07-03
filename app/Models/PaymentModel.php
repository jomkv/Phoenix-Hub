<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
  protected $table = 'payments';
  protected $primaryKey = 'payment_id';

  protected $useAutoIncrement = true;

  protected $returnType     = \App\Entities\Payment::class;
  // protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['amount', 'email', 'full_name'];
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
    'amount'                    => 'required',
    'email'                     => 'required',
    'full_name'                 => 'required',
  ];

  protected $validationMessages   = [
    'amount' => [
      'required'    => 'amount must be provided',
    ],
    'email' => [
      'required'    => 'email must be provided',
    ],
    'full_name' => [
      'required'    => 'full_name must be provided',
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
