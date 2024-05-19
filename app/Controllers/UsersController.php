<?php

namespace App\Controllers;

class UsersController extends BaseController
{
  public function index(): string
  {
    return view('welcome_message');
  }

  /**
   * @desc Returns a view to login page
   * @route GET /login
   * @access public
   */
  public function viewLogin(): string
  {
    return view('pages/user/loginPage');
  }

  /**
   * @desc Returns a view to signup page
   * @route GET /signup
   * @access public
   */
  public function viewSignup(): string
  {
    return view('pages/user/loginPage');
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
