<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Entities\Student;

class UsersController extends BaseController
{
  private $model;

  public function __construct()
  {
    $this->model = new StudentModel();
  }

  public function index(): string
  {
    return view('welcome_message');
  }

  /**
   * @desc Returns a view to login page
   * @route GET /login
   * @access public
   */
  public function viewLogin()
  {
    if (auth()->loggedIn()) {
      return redirect()->to('/')->with("info", "User already logged in");
    }

    return view('pages/user/login');
  }

  /**
   * @desc Returns a view to signup page
   * @route GET /signup
   * @access public
   */
  public function viewSignup()
  {
    if (auth()->loggedIn()) {
      return redirect()->to('/')->with("info", "User already logged in");
    }

    return view('pages/user/signup');
  }

  /**
   * @desc User login
   * @route POST /login
   * @access public
   */
  public function login()
  {
    try {
      // * TODO
    } catch (\Exception $e) {
      // * TODO
      // Sample Code from Gemini:
      // log_message('error', 'Error updating product: ' . $e->getMessage());
      // return redirect()->to('/products')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Registers a new user at the users and users_shield tables
   * @route POST /signup
   * @access public
   */
  public function signup()
  {
    try {
      // * TODO
    } catch (\Exception $e) {
      // * TODO
      // Sample Code from Gemini:
      // log_message('error', 'Error updating product: ' . $e->getMessage());
      // return redirect()->to('/products')->with('error', 'An error occurred. Please try again later.');
    }
  }
}
