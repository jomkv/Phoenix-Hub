<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Admin Signup <?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1> Admin Signup </h1>

<?= form_open('/signup/admin') ?>
<label for="title">Username</label>
<input type="text" name="username" id="username">

<label for="content">Email</label>
<input type="text" name="email" id="email">

<label for="content">Password</label>
<input type="password" name="password" id="password">

<button type="submit">Signup</button>
</form>

<?= $this->endSection() ?>