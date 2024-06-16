<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $auth = auth();

    // * Check if logged in
    if (!$auth->loggedIn()) {
      return redirect()->to('/')->with('error', 'User not logged in.');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
