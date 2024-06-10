<?php helper('form'); ?>

<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Organization Products<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="container" style="background-color: pink; ">
  <div class="row mt-100">
    <div class=" col-md-3">
      <div class="product-wrapper mb-45 text-center">
        <div class="product-img">
          <a href="#" data-abc="true">
            <img src="https://i.imgur.com/tL7ZE46.jpg" alt="">
          </a>
          <span><i class="fa fa-rupee"></i> 43,000</span>
          <div class="product-action">
            <div class="product-action-style">
              <a href="#"><i class="fa fa-plus"></i></a>
              <a href="#"><i class="fa fa-heart"></i></a>
              <a href="#"><i class="fa fa-shopping-cart"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="product-wrapper mb-45 text-center">
        <div class="product-img">
          <a href="#" data-abc="true">
            <img src="https://i.imgur.com/lAQxXCK.jpg" alt="">
          </a>
          <span><i class="fa fa-rupee"></i> 41,000</span>
          <div class="product-action">
            <div class="product-action-style">
              <a class="action-plus" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#" data-abc="true">
                <i class="fa fa-plus"></i>
              </a>
              <a class="action-heart" title="Wishlist" href="#" data-abc="true">
                <i class="fa fa-heart"></i>
              </a>
              <a class="action-cart" title="Add To Cart" href="#" data-abc="true">
                <i class="fa fa-shopping-cart"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="product-wrapper mb-45 text-center">
        <div class="product-img">
          <a href="#" data-abc="true">
            <img src="https://i.imgur.com/HxEEu5g.jpg" alt="">
          </a>
          <span><i class="fa fa-rupee"></i> 33,000</span>
          <div class="product-action">
            <div class="product-action-style">
              <a class="action-plus" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#" data-abc="true">
                <i class="fa fa-plus"></i>
              </a>
              <a class="action-heart" title="Wishlist" href="#" data-abc="true">
                <i class="fa fa-heart"></i>
              </a>
              <a class="action-cart" title="Add To Cart" href="#" data-abc="true">
                <i class="fa fa-shopping-cart"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="product-wrapper mb-45 text-center">
        <div class="product-img">
          <a href="#" data-abc="true">
            <img src="https://i.imgur.com/lAQxXCK.jpg" alt="">
          </a>
          <span><i class="fa fa-rupee"></i> 23,000</span>
          <div class="product-action">
            <div class="product-action-style">
              <a class="action-plus" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#" data-abc="true">
                <i class="fa fa-plus"></i>
              </a>
              <a class="action-heart" title="Wishlist" href="#" data-abc="true">
                <i class="fa fa-heart"></i>
              </a>
              <a class="action-cart" title="Add To Cart" href="#" data-abc="true">
                <i class="fa fa-shopping-cart"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?= $this->endSection() ?>