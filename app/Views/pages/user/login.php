<?php helper('form'); ?>

<?= $this->extend("layouts/loginSignup") ?>

<?= $this->section("title") ?>Login<?= $this->endSection() ?>

<?= $this->section("content") ?>

<?= form_open('/login') ?>
<div class="row mx-auto row-cols-1 w-50 shadow-lg p-5" style="background-color: white;">
  <div class="col">
    <h1 class="mb-5">Login</h1>
  </div>
  <div class="col">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-5">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password">
    </div>
  </div>
  <div class="col-12 text-center">
    <button type="submit" class="btn btn-primary w-50 h-100 mt-2">Login</button>
  </div>
</div>
</form>

<?= $this->endSection() ?>