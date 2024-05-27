<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Product Menu <?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="card mb-3" style="margin-top:150px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="<?= base_url() . 'White Tshirt.jpg' ?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">On God</h5>
        <p class="card-text">This t-shirt is made of God.</p>
        <div class="col-md-8 mx-auto d-block" style="margin-top:200px;">
        <a class="btn btn-primary" href="#" role="button">Link</a>
            <button class="btn btn-primary" type="submit">Button</button>
            <input class="btn btn-primary" type="button" value="Input">
            <input class="btn btn-primary" type="submit" value="Submit">
            <input class="btn btn-primary" type="reset" value="Reset">
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>