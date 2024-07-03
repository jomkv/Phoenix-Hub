<?php helper('form'); ?>

<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Create Barter Post <?= $this->endSection() ?>

<?= $this->section("content") ?>

<a href="<?= url_to("BarterController::viewBarterHome") ?>" class="back-button"><i class="bi bi-arrow-left"></i></a>

<div class="text-center page-container">
    <div class="container mt-2 text-start">
        <div class="row">
            <div class="col-lg-5 col-md-8 mt-3 pb-5">
                <h1>CREATE POST</h1>
                <?= form_open_multipart('/barter/new', ['class' => 'custom_form_container p-4 shadow-lg']) ?>
                <div class="mb-3">
                    <label for="title">Post Title</label>
                    <input class="form-control" type="text" id="title" name="title" value="<?= old("title") ?>">
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"><?= old("description") ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="barter_category">Category</label>
                    <select class="form-select" id="barter_category" name="barter_category">
                        <option value="">Select a category</option>
                        <option value="swap">Swap</option>
                        <option value="for_sale">For Sale</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price">Price (PHP)</label>
                    <input class="form-control" type="number" id="price" name="price" pattern="\d+(\.\d{1,2})?" title="Please enter a valid price in PHP (numeric values only)" placeholder="1000.00" value="<?= old("price") ?>">
                </div>
                <div class="mb-3">
                    <label for="file">Upload File</label>
                    <input class="form-control" type="file" name="upload" class="form-control" accept="image/*">
                </div>

                <button class="btn btn-primary w-100 mb-3 fw-semibold fs-5" type="submit" id="submit-create-btn" style="background-color: #7433fa; border-color: #7433fa;" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Submit Post</button>
                <?php if (session()->has("errors")) : ?>
                    <div class="bg-danger-subtle text-dark border-danger border-start border-4 rounded" style="padding: 10px; padding-left: 15px;">
                        <h4 class="fw-bold">Something went wrong</h4>
                        <ul>
                            <?php foreach (session("errors") as $error) : ?>
                                <li class="fw-medium"><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #dee2e6;
    }

    /* Back button style */
    .back-button {
        position: fixed;
        top: 100px;
        left: 10px;
        z-index: 100;
        width: 50px;
        height: 50px;
        background-color: #7433FA;
        color: white;
        border: none;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        text-decoration: none;
    }

    .container .row .col-lg-5 {
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .custom_form_container {
        background-color: #EEEEEE;
        border-radius: 5px;
    }

    .page-container {
        margin-top: 120px;
    }
</style>
<?= $this->endSection() ?>