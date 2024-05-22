<?php

namespace App\Controllers;

use CodeIgniter\Shield\Entities\User;

class AdminController extends BaseController
{
  /**
   * @desc admin login
   * @route POST /admin/login
   * @access public
   */
  public function login()
  {
    try {
      $auth = auth();

      // * Check if user already logged in
      if ($auth->loggedIn()) {
        return redirect()->to('/admin')->with('error', 'Already logged in.');
      }

      $data = $this->request->getPost();

      $loginAttempt = $auth->attempt($data);

      // * If login attempt fail, redirect back to login
      if (!$loginAttempt->isOK()) {
        return redirect()->to('/login/admin')->with('error', 'Wrong credentials. Please try again.');
      }

      log_message('info', 'Admin ' . $data['email'] . ' logged in.');
      return redirect()->to('/admin')->with('info', 'User logged in.');
    } catch (\Exception $e) {
      log_message('error', 'Error admin login: ' . $e->getMessage());
      return redirect()->to('/login/admin')->with('error', 'An error occurred. Please try again.');
    }
  }

  /**
   * @desc Registers a new admin
   * @route POST /admin/signup
   * @access public
   */
  public function signup()
  {
    try {
      $data = $this->request->getPost();

      // Get shield's User Provider
      $users = auth()->getProvider();

      $user = new User($data);

      $users->save($user);

      // * Get new user
      $user = $users->findById($users->getInsertID());

      // * Give new user admin role
      $user->addGroup('superadmin');

      return redirect()->to('/login/admin');
    } catch (\Exception $e) {
      log_message('error', 'Error admin signup: ' . $e->getMessage());
      return redirect()->to('/signup/admin')->with('error', 'An error occurred. Please try again.');
    }
  }

  /**
   * @desc Ends current logged in session
   * @route POST /admin/logout
   * @access public
   */
  public function logout()
  {
    try {
      $auth = auth();

      if (!$auth->loggedIn()) {
        return redirect()->to('/login/admin')->with('error', 'Logout failed, session not detected.');
      }

      $auth->logout();

      return redirect()->to('/login/admin');
    } catch (\Exception $e) {
      log_message('error', 'Error admin logout: ' . $e->getMessage());
      return redirect()->to('/login/admin')->with('error', 'An error occurred. Please try again.');
    }
  }
}
