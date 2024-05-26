<?= $this->extend("layouts/adminDefault") ?>

<?= $this->section("title") ?>Admin | Dashboard <?= $this->endSection() ?>

<?= $this->section("content") ?>
<style>
    h1{
        text-align: center;
    }
</style>
<h1>Admin Dashboard</h1>
<div class="container fluid-hidden text-center">
  <div class="row gy-4 column mt-4">
    <div class="col-6">
      <div class="p-3" style="background-color:red; height: 300px;" >Tites</div>
    </div>
    <div class="col-6">
      <div class="p-3" style="background-color:pink; height: 300px;">Custom column padding</div>
    </div>
    <div class="col-6">
      <div class="p-3" style="background-color:green; height: 300px;">Custom column padding</div>
    </div>
    <div class="col-6">
      <div class="p-3" style="background-color:lightblue;height: 300px;">Custom column padding</div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>