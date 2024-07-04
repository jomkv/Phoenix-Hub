<?php

namespace App\Models;

use CodeIgniter\Model;

class BarterModel extends Model
{
  protected $table = 'barter_posts';
  protected $primaryKey = 'barter_id';

  protected $returnType = \App\Entities\Barter::class;

  protected $allowedFields = ['student_id', 'title', 'description', 'status', 'barter_category', 'price', 'images'];

  protected $validationRules = [
    'student_id'        => 'required',
    'title'             => 'required|max_length[255]',
    'description'       => 'required|max_length[255]',
    'barter_category'   => 'required',
    'price'             => 'numeric|greater_than[0]',
    'image'             => 'required_without[student_id]',
  ];
  protected $validationMessages   = [
    'student_id' => [
      'required'    => 'Student must be logged in'
    ],
    'title' => [
      'required'    => 'Post title must be provided',
      'max_length'  => 'Post title too long'
    ],
    'description' => [
      'required'    => 'Description must be provided',
      'max_length'  => 'Description too long'
    ],
    'barter_category' => [
      'required'    => 'Category must be provided',
    ],
    'price' => [
      'greater_than'  => 'Product Price must be greater than 0',
      'numeric'       => 'Product Price must be a valid number'
    ],
    'images' => [
      'required_without'  => 'Product Image must be provided',
    ],
  ];
}
