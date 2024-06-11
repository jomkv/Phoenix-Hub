<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizationModel extends Model
{
  protected $table = 'organizations';
  protected $primaryKey = 'organization_id';

  protected $useAutoIncrement = true;

  protected $returnType     = \App\Entities\Organization::class;
  protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['organization_id', 'name', 'full_name', 'contact_email', 'contact_person', 'logo'];
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
    'organization_id'      => 'permit_empty',
    'name'                 => 'required|max_length[255]|is_unique[organizations.name, organization_id, {organization_id}]',
    'full_name'            => 'required|max_length[65530]',
    'contact_email'        => 'required|max_length[254]|valid_email',
    'contact_person'       => 'required|max_length[100]',
    'logo'                 => 'required_without[organization_id]|max_length[500]'
  ];

  protected $validationMessages   = [
    'name' => [
      'required'    => 'Organization Name must be provided',
      'max_length'  => 'Organization Name too long',
      'is_unique'   => 'Organization Name already taken',
    ],
    'full_name' => [
      'required'    => 'Organization Full Name must be provided',
      'max_length'  => 'Organization Full Name too long'
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
    'logo' => [
      'required_without'    => 'Logo was either not provided, or there was a problem processing it',
      'max_length'          => 'Uploaded Logo filename is too long',
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
