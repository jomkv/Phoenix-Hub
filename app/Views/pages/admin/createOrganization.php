<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Create Organization <?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1> Create Organization </h1>

<?= form_open('/admin/organization/new') ?>
<label for="organization_name">Organization Name</label>
<input type="text" name="organization_name" id="organization_name">

<label for="description">Description</label>
<input type="text" name="description" id="description">

<label for="contact_email">Contact Email</label>
<input type="text" name="contact_email" id="contact_email">

<label for="contact_person">Contact Person</label>
<input type="text" name="contact_person" id="contact_person">

<button type="submit">Create</button>
</form>

<?= $this->endSection() ?>