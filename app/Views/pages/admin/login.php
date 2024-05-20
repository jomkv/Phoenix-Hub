<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Admin Login <?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1> Admin Login </h1>

<?= form_open('/login/admin') ?>
<label for="content">Email</label>
<input type="text" name="email" id="email">

<label for="content">Password</label>
<input type="password" name="password" id="password">

<button type="submit">Login</button>
</form>

<?= $this->endSection() ?>