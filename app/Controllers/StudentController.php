<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Entities\Student;
use CodeIgniter\Shield\Entities\User;

class StudentController extends BaseController
{
  protected $helpers = ['form', 'upload'];
  private $model;

  public function __construct()
  {
    $this->model = auth()->getProvider();
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
   * @desc student login
   * @route POST /login
   * @access public
   */
  public function login()
  {
    try {
      $auth = auth();

      // * Check if user already logged in
      if ($auth->loggedIn()) {
        return redirect()->to('/')->with('error', 'Already logged in.');
      }

      $data = $this->request->getPost();

      $loginAttempt = $auth->attempt($data);
      // * If login attempt fail, redirect back to login
      if (!$loginAttempt->isOK()) {
        return redirect()->back()
          ->with('errors', ['Wrong credentials. Please try again.'])
          ->withInput();
      }

      return redirect()->to('/')->with('info', 'User logged in.');
    } catch (\Exception $e) {
      log_message('error', 'Error student login: ' . $e->getMessage());
      return redirect()->back()->with('error', 'An error occurred. Please try again.');
    }
  }

  /**
   * @desc Registers a new student at the students table and users (shield builtin) table
   * @route POST /signup
   * @access public
   */
  public function signup()
  {
    if (auth()->loggedIn()) {
      return redirect()->to('/')->with("info", "User already logged in");
    }

    $data = $this->request->getPost();

    if (!$this->model->validate($data)) {
      $errors = $this->model->errors();

      // if (empty($data["password"])) {
      //   array_push($errors, "Password must be provided.");
      // }

      // if (empty($data["confirm-password"])) {
      //   array_push($errors, "Confirm Password must be provided.");
      // }

      return redirect()->back()
        ->with('errors', $errors)
        ->withInput();
    }

    try {
      $newStudentId = $this->model->insert($data);

      if (!$newStudentId) {
        return redirect()->back()
          ->with('errors', $this->model->errors())
          ->withInput();
      } else {
        $data['student_id'] = $newStudentId;
      }

      // Save Student Identity to Auth Shield
      $users = auth()->getProvider();
      $user = new User($data);
      $users->save($user);

      return redirect()->to('/login');
    } catch (\Exception $e) {
      log_message('error', 'Error admin signup: ' . $e->getMessage());
      return redirect()->to('/')->with('error', 'An error occurred. Please try again later.');
    }
  }

  /**
   * @desc Ends current logged in session
   * @route POST /logout
   * @access public
   */
  public function logout()
  {
    try {
      $auth = auth();

      if (!$auth->loggedIn()) {
        return redirect()->to('/login')->with('error', 'Logout failed, session not detected.');
      }

      $auth->logout();
      return redirect()->to('/login');
    } catch (\Exception $e) {
      log_message('error', 'Error student logout: ' . $e->getMessage());
      return redirect()->to('/')->with('error', 'An error occurred.');
    }
  }
}
