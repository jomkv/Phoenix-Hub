<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Product Menu <?= $this->endSection() ?>

<?= $this->section("content") ?>
<style>
  body{
    background-color:#1B1B1B;
  }
  .buttons{
    margin-right:50px;
  }
</style>
<div class="card mb-3" style="margin-top:150px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="<?= base_url() . 'White Tshirt.jpg' ?>" class="img-fluid rounded mx-auto d-block" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title mt-5 fs-2 fw-bolder">T-Shirt</h5>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam exercitationem hic dolore pariatur, eveniet blanditiis eligendi ea reiciendis vitae odio sit iste dolor esse ducimus eum assumenda, cupiditate nostrum aliquid! Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur facilis vel beatae explicabo. Unde atque necessitatibus consequatur sapiente quidem deleniti, delectus fuga blanditiis cupiditate eaque animi architecto, aliquid amet dignissimos! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit ad laudantium illo est expedita aliquam consectetur, nostrum reiciendis et delectus commodi mollitia doloribus repellat temporibus culpa provident a omnis non?</p>
        <div class="col-md-8 mx-auto d-block mx-auto" style="margin:50px;">
        <a class="btn btn-warning buttons fw-bold" href="#" role="button">Check Out </a>
            <button class="btn btn-warning buttons fw-bold" type="submit">Barter</button>
            <input class="btn btn-warning buttons fw-bold" type="button" value="Input">
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>