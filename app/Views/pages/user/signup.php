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
</div>
</form>

<?= $this->endSection() ?>