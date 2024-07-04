<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Manage Barter <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
    .image-container {
        max-width: 100%;
        height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        border-radius: 5px;
    }

    .image-container img {
        max-width: 100%;
        height: auto;
        display: block;
        object-fit: contain;
    }

    .profile-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        align-items: center;
    }

    .profile-container img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        object-fit: cover;
        margin-right: 10px;
    }

    .card-header .profile-name {
        font-weight: bold;
        color: black;
    }

    .description h5 {
        margin-bottom: 0px;
    }

    .card-footer {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="row w-100 mt-4">
    <div class="col-12 col-md-6 d-flex order-md-1 w-100">
        <div class="card flex-fill border-0 w-100">
            <div class="card-body py-4">
                <!-- CARD HEADER -->
                <div class="row h-auto justify-content-between w-100">
                    <div class="col-12 align-items-center">
                        <h1>Pending Barter Posts</h1>
                    </div>
                </div>

                <div class="table-responsive rounded mt-2">
                    <table class="table table-hover table-bordered table-striped text-center w-100 mt-3" id="products-table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col text-start" style="text-align:center;">ID</th>
                                <th scope="col text-start" style="text-align:center;">Seller</th>
                                <th scope="col text-start" style="text-align:center;">Title</th>
                                <th scope="col text-start" style="text-align:center;">Date</th>
                                <th scope="col text-start" style="text-align:center;">View</th>
                                <th scope="col text-start" style="text-align:center;">Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payload as $post) : ?>
                                <tr>
                                    <td class="text-center"><?= $post["post"]->barter_id ?></td>
                                    <td class="text-center"><?= esc($post["student"]->full_name) ?></td>
                                    <td class="text-center"><?= esc($post["post"]->title) ?></td>
                                    <td class="text-center"><?= $post["post"]->date ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-primary view-post-btn" data-post-id="<?= $post["post"]->barter_id ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-eye-fill"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-success approve-post-btn" data-post-id="<?= $post["post"]->barter_id ?>" data-bs-toggle="modal" data-bs-target="#confirmModal"><i class="bi bi-check-lg"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="order-header-container">Post Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card text-start" style="margin-top: 10px;">
                    <div class="image-container mx-auto d-block">
                        <img src="#" class="img-fluid" style="max-width: auto; height: 100%;" alt="Barter Post Image" id="preview_image">
                    </div>
                    <div class="card-header">
                        <div class="profile-container">
                            <img src="<?= base_url() . "student (2).png" ?>" alt="Profile Picture" style="border: 3px solid #7532FA;">
                            <p class="profile-name" style="margin-bottom: 0px;" id="preview_fullname">Rhondel Divinasflores</p>
                            <small class="text-muted" style="margin-left: 10px;" id="preview_date"><?= date('F j, Y') ?></small>
                        </div>
                        <div class="product-title d-flex align-items-center mb-2">
                            <p class="fw-semibold fs-3" style="margin-bottom: 0px; margin-right: 20px;" id="preview_title">School Uniform</p>
                            <p style="color: #ee4d42;" class="card-text fs-3" id="preview_price">₱123</p>
                        </div>
                        <div class="description">
                            <p id="preview_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sagittis, nisi vitae sollicitudin lobortis.</p>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approve Post Modal -->
<div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="approve_post_header">Approve Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fs-5" style="color: black;">This action cannot be undone, are you sure you want to approve this post?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form action="<?= base_url() ?>admin/barter/approve/-1" method="post" accept-charset="utf-8" id="approve-post-form">
                    <button type="submit" class="btn btn-success" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>


<script>
    let deleteProductId;

    $(document).ready(function() {
        // Initialize DataTable with additional options
        $('#products-table').DataTable({
            paging: false,
            info: false,
            responsive: true,
            columnDefs: [{
                    orderable: false,
                    targets: [-1, -2]
                } // Disable ordering on the Actions column
            ],
            language: {
                search: "Search post:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "No entries available",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                }
            }
        });

        $('.approve-post-btn').click(function() {
            $('#approve_post_header').text(`Approve Post #${$(this).data('post-id')}`);
            $('#approve-post-form').attr('action', `<?= base_url() ?>admin/barter/approve/${$(this).data('post-id')}`)
        });

        $('.view-post-btn').click(function() {
            let url = '<?= base_url() ?>' + `admin/barter/${$(this).data('post-id')}`;

            $.ajax({
                url: url,
                type: 'POST',
                success: (data) => {
                    console.log(data)
                    updatePreviewModal(data);
                },
                error: (err) => {
                    console.log(err);
                }
            })
        })
    })

    function updatePreviewModal(data) {
        var imageEl = $("#preview_image");
        var fullnameEl = $("#preview_fullname");
        var dateEl = $("#preview_date");
        var titleEl = $("#preview_title");
        var priceEl = $("#preview_price");
        var descriptionEl = $("#preview_description");

        var image = JSON.parse(data.post.images)

        imageEl.attr("src", image.url);
        fullnameEl.text(data.student.full_name);
        dateEl.text(data.post.date);
        titleEl.text(data.post.title);
        if (data.post.barter_category === "swap") {
            priceEl.html('<p class="badge text-bg-warning fs-5">Swap</p>')
        } else {
            priceEl.text(`₱${data.post.price}`);
        }
        descriptionEl.text(data.post.description);
    }
</script>

<?= $this->endSection() ?>