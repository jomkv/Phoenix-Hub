<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizationModel extends Model
{
  protected $table = 'organizations';
  protected $primaryKey = 'organization_id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['organization_name', 'description', 'contact_email', 'contact_person', 'logo_url'];
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
    'organization_name' => 'required|max_length[255]',
    'description'       => 'required|max_length[65530]',
    'contact_email'     => 'required|max_length[254]|valid_email',
    'contact_person'    => 'required|max_length[100]',
    'logo_url'          => 'max_length[255]'
  ];

  protected $validationMessages   = [
    'organization_name' => [
      'required'    => 'Organization Name must be provided',
      'max_length'  => 'Organization Name too long'
    ],
    'description' => [
      'required'    => 'Description must be provided',
      'max_length'  => 'Description too long'
    ],
    'contact_email' => [
      'required'    => 'Contact Email must be provided',
      'max_length'  => 'Contact Email too long',
      'valid_email' => 'Contact Email is an invalid Email',
    ],
    'contact_person' => [
      'required'    => 'Contact Person must be provided',
      'max_length'  => 'Contact Person too long',
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
