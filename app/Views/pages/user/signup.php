<?php helper('form'); ?>

<?= $this->extend("layouts/loginSignup") ?>

<?= $this->section("title") ?>Signup<?= $this->endSection() ?>

<?= $this->section("content") ?>

<?= form_open('/signup') ?>
<div class="row mx-auto row-cols-1 w-50 shadow-lg p-5" style="background-color: white;">
  <div class="col">
    <h1 class="mb-4">Signup</h1>
  </div>
  <div class="col">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" name="email" id="email">
    </div>
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password">
    </div>
    <div class="mb-4">
      <label for="confirm-password" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="confirm-password" id="confirm-password">
    </div>
  </div>
  <div class="col-12 text-center">
    <button type="submit" class="btn btn-primary w-50 h-100">Signup</button>
  </div>
  <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>
</div>
</form>

<?= $this->endSection() ?>