<?php helper('form'); ?>

<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Create Task <?= $this->endSection() ?>

<?= $this->section("content") ?>

<?= form_open('/tasks/new') ?>
<label for="title">Title</label>
<input type="text" name="title" id="title">

<label for="content">Content</label>
<textarea name="content" id="content"></textarea>

<button type="submit">Save</button>
</form>

<?= $this->endSection() ?>