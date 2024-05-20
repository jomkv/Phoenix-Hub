<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $auth = auth();

    // * Check if logged in
    if (!$auth->loggedIn()) {
      return redirect()->to('/login/admin');
    }

    // * Check if admin
    if (!$auth->user()->inGroup('superadmin')) {
      return redirect()->to('/')->with('error', 'User not authorized.');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
