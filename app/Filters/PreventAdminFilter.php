<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PreventAdminFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    /**
     * Used for routes that require student information.
     * Prevents errors since admin(s) do not have student information set.
     */

    // * If admin, redirect
    if (auth()->user()->inGroup('superadmin')) {
      return redirect()->to('/')->with('error', 'This action is for students only.');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
