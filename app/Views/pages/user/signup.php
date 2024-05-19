<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Signup<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Signup</h1>

<?= form_open('/signup') ?>
<label for="email">Email</label>
<input type="text" name="email" id="email">

<label for="username">Username</label>
<input type="text" name="username" id="username">

<label for="password">Password</label>
<input type="password" name="password" id="password">

<button type="submit">Signup</button>
</form>

<?= $this->endSection() ?>