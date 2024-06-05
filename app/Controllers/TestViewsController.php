<?php

namespace App\Controllers;

class TestViewsController extends BaseController
{

  /**
   * @desc view organization's products offered
   * @route GET /test/orgProducts
   * @access PUBLIC
   */
  public function viewOrgProducts()
  {
    return view('pages/organization/productsOffered.php');
  }

  /**
   * @desc view product checkout form
   * @route GET /test/checkoutForm
   * @access PUBLIC
   */
  public function viewCheckoutForm()
  {
    return view('pages/product/checkoutForm.php');
  }

  /**
   * @desc view product checkout confirmation
   * @route GET /test/checkoutConfirm
   * @access PUBLIC
   */
  public function viewCheckoutConfirm()
  {
    return view('pages/product/checkoutConfirm.php');
  }

  /**
   * @desc view barter menu
   * @route GET /test/barterHome
   * @access PUBLIC
   */
  public function viewBarter()
  {
    return view('pages/barter/tradingCenter.php');
  }

  /**
   * @desc view specific barter post
   * @route GET /test/barterItem
   * @access PUBLIC
   */
  public function viewBarterPost()
  {
    return view('pages/barter/barter.php');
  }

  /**
   * @desc view create barter item form
   * @route GET /test/createBarter
   * @access PUBLIC
   */
  public function viewCreateBarter()
  {
    return view('pages/barter/createBarterForm.php');
  }
}
