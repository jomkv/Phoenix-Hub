<?php

namespace App\Models;

use CodeIgniter\Model;

class BarterModel extends Model
{
  protected $table = 'barter_posts';
  protected $primaryKey = 'barter_id';
  protected $allowedFields = ['student_id', 'title', 'description', 'barter_category', 'price', 'image'];

  protected $validationRules = [
    'title'             => 'required|max_length[8]',
    'description'       => 'required|max_length[255]',
    'barter_category'   => 'required|in_list[swap,For Sale]', // Maintains validation for specific ENUM values
    'price'             => 'required|numeric|greater_than[0]',
    'image'             => 'required_without[student_id]',
  ];
  protected $validationMessages   = [
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
      'in_list'     => 'You must pick in Category'
    ],
    'price' => [
      'required'      => 'Product Price must be provided',
      'greater_than'  => 'Product Price must be greater than 0',
      'numeric'      => 'Product Price must be a valid number'
    ],
    'images' => [
      'required_without'  => 'Product Image(s) must be provided',
    ],
  ];
}
