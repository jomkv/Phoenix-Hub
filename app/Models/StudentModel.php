<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
  protected $table = 'students';
  protected $primaryKey = 'student_id';

  protected $useAutoIncrement = true;

  protected $returnType     = \App\Entities\Student::class;
  protected $useSoftDeletes = true; // Only modify entity's 'deleted_at' column, instead of hard delete

  protected $allowedFields = ['username', 'email', 'student_number', 'full_name', 'phone_number', 'pfp'];
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
    'username'           => 'required|max_length[255]|is_unique[students.username]',
    'email'              => 'required|max_length[65530]|valid_email|cvsu_email|is_unique[students.email]',
    'student_number'     => 'required|exact_length[9]|numeric|is_unique[students.student_number]',
    'full_name'          => 'required|max_length[100]',
    'phone_number'       => 'required|exact_length[11]|numeric',
    'pfp'                => 'max_length[500]'
  ];

  protected $validationMessages   = [
    'username' => [
      'required'    => 'Username must be provided',
      'max_length'  => 'Username too long',
      'is_unique'   => 'Username already taken'
    ],
    'email' => [
      'required'    => 'Email must be provided',
      'max_length'  => 'Email too long',
      'valid_email' => 'Email format invalid',
      'cvsu_email'  => 'Email must be a CvSU Email',
      'is_unique'   => 'Email already taken'
    ],
    'student_number' => [
      'required'      => 'Student Number must be provided',
      'exact_length'  => 'Student Number must be 9 digits',
      'is_unique'     => 'Student Number is already in use',
    ],
    'full_name' => [
      'required'      => 'Full Name must be provided',
      'max_length'    => 'Full Name too long',
    ],
    'phone_number' => [
      'required'      => 'Phone Number must be provided',
      'exact_length'  => 'Phone Number must be 11 digits',
    ],
    'pfp' => [
      'max_length'    => 'Uploaded PFP filename is too long',
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
