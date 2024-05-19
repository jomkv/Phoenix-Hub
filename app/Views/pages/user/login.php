<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Login<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Login</h1>

<?= form_open('/login') ?>
<label for="email">Email</label>
<input type="text" name="email" id="email">

<label for="password">Password</label>
<input type="password" name="password" id="password">

<button type="submit">Login</button>
</form>

<?= $this->endSection() ?>