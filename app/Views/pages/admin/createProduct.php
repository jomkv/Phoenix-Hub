<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Add Product <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="text-center">
  <div class="container text-start">
    <form class="needs-validation" novalidate enctype="multipart/form-data" method="post" action="<?= base_url() . "admin/product/new" ?>">
      <div class="row mt-4 mb-5">
        <input type="hidden" id="option_count_hidden" value="1" name="option_count_hidden">
        <div class="col-12 d-flex justify-content-center">
          <div class="w-75">
            <h1>Add Product</h1>
          </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
          <div class="custom_form_container shadow-lg p-4 card-custom-container">
            <h3 class="mb-3">Basic information</h3>

            <!-- PRODUCT ORG -->
            <div class="mb-3">
              <label for="organization_id">Product's Organization</label>
              <select name="organization_id" id="organization_id" class="form-select" style="background-color: white;">
                <?php foreach ($organizations as $org) : ?>
                  <option value="<?= $org->organization_id; ?>" <?= old('organization_id') && (old('organization_id') == $org->organization_id) ? "selected" : "" ?>>
                    <?= esc($org->name) ?>
                  </option>
                <?php endforeach ?>
              </select>
            </div>

            <!-- PRODUCT NAME -->
            <div class="mb-3">
              <label for="product_name">Product Name</label>
              <input type="text" name="product_name" id="product_name" class="form-control" style="background-color: white;" value="<?= esc(old('product_name')) ?>" required>
              <div class="invalid-feedback">
                Please provide a product name.
              </div>
            </div>


            <!-- DESCRIPTION -->
            <div class="mb-3">
              <label for="description">Description</label>
              <textarea type="text" name="description" id="description" class="form-control" style="background-color: white; resize: none;" rows="4" required><?= esc(old('description')) ?></textarea>
              <div class="invalid-feedback">
                Please provide a description.
              </div>
            </div>

            <!-- IMAGES -->
            <div class="mb-3">
              <label for="formFileMultiple" class="form-label">Image(s)</label>
              <input type="file" name="fileuploads[]" class="form-control" accept="image/*" multiple required>
              <div class="invalid-feedback">
                Please provide 1-4 image(s).
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 d-flex justify-content-center mt-4">
          <div class="custom_form_container shadow-lg p-4 card-custom-container">
            <h3 class="mb-3">Sales information</h3>

            <!-- VARIATIONS CHECKBOX -->
            <div class="form-check form-switch mb-3">
              <input class="form-check-input" type="checkbox" role="switch" name="has_variations" id="has_variations" value="has_variations">
              <label class="form-check-label" for="has_variations">Product Variations</label>
            </div>

            <!-- VARIATION NAME -->
            <div id="variations_container" class="d-none">
              <div class="mb-3">
                <label for="variation_name">Variation Name</label>
                <input type="text" name="variation_name" id="variation_name" class="form-control" style="background-color: white;" placeholder="Sizes">
                <div class="invalid-feedback">
                  Please provide a variation name.
                </div>
              </div>
              <div id="options_container" class="">
                <div id="option_1" class="mb-3 p-3 option-custom-container">
                  <div class="row row-cols-2">
                    <div class="col-10">

                      <!-- OPTION NAME -->
                      <div class="mb-3">
                        <label for="option_name_1">Option 1 Name</label>
                        <input type="text" name="option_name_1" id="option_name_1" class="form-control" style="background-color: white;" placeholder="Small, Medium, etc...">
                        <div class="invalid-feedback">
                          Please provide Option 1 Name.
                        </div>
                      </div>

                      <!-- PRICE -->
                      <div class="mb-3">
                        <label for="option_price_1">Price</label>
                        <div class="input-group">
                          <span class="input-group-text">₱</span>
                          <input type="number" name="option_price_1" id="option_price_1" class="form-control" style="background-color: white;">
                          <div class="invalid-feedback">
                            Please provide Option 1 Price.
                          </div>
                        </div>
                      </div>

                      <!-- STOCK -->
                      <div>
                        <label for="option_stock_1">Stock</label>
                        <input type="number" name="option_stock_1" id="option_stock_1" class="form-control" style="background-color: white;">
                        <div class="invalid-feedback">
                          Please provide Option 1 Stock.
                        </div>
                      </div>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-center">
                      <button type="button" class="btn btn-danger" disabled style="height: 50px;" aria-label="Remove"><i class="bi bi-x-lg"></i></button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- SUBMIT -->
              <button type="button" onclick="handleAddOption()" class="mb-3 p-3 option-custom-container add-option-container w-100">
                <i class="bi bi-plus-lg"></i> Add Option
              </button>
            </div>

            <div id="no_variations_container">
              <div class="mb-3 ">
                <label for="price">Price</label>
                <div class="input-group">
                  <span class="input-group-text">₱</span>
                  <input type="number" name="price" id="price" class="form-control" style="background-color: white;" value="<?= esc(old('price')) ?>" required>
                  <div class="invalid-feedback">
                    Please provide a product price.
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" style="background-color: white;" value="<?= esc(old('stock')) ?>" required>
                <div class="invalid-feedback">
                  Please provide a product stock.
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3 fs-6 fw-bold pt-3 pb-3">Create Product</button>

            <?php if (session()->has("errors")) : ?>
              <div class="bg-danger-subtle text-dark border-danger border-start border-4 rounded" style="padding: 10px; padding-left: 15px;">
                <h4 class="fw-bold">Something went wrong</h4>
                <ul>
                  <?php foreach (session("errors") as $error) : ?>
                    <li class="fw-medium">• <?= $error ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-12"></div>
      </div>
    </form>
  </div>
</div>

<style>
  .custom_form_container {
    background-color: #EEEEEE;
    border-radius: 5px;
  }

  .card-custom-container {
    width: 75% !important;
  }

  .option-custom-container {
    background-color: #ebebeb;
    border: 1px dashed black;
  }


  .add-option-container {
    transition: 0.4s;
  }

  .add-option-container:hover {
    background-color: #d1cfcf;
    border: 1px solid black;
  }

  .add-option-container:active {
    background-color: #b3afaf;
    border: 1px solid black;
  }


  @media (max-width: 767px) {
    .card-custom-container {
      width: 100% !important;
    }
  }
</style>

<script>
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      const forms = document.getElementsByClassName('needs-validation');
      Array.prototype.filter.call(forms, function(form) {
        // Add event listener for both submit and change events
        form.addEventListener('submit', validateForm);
        form.addEventListener('change', validateInput);

        function validateForm(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          // Remove existing "is-invalid" classes before adding new ones
          const previouslyInvalid = form.querySelectorAll('.is-invalid');
          for (let i = 0; i < previouslyInvalid.length; i++) {
            previouslyInvalid[i].classList.remove('is-invalid');
          }
          const invalidGroup = form.querySelectorAll(':invalid');
          for (let j = 0; j < invalidGroup.length; j++) {
            invalidGroup[j].classList.add('is-invalid');
          }
        }

        function validateInput(event) {
          const input = event.target;
          if (input.checkValidity()) {
            input.classList.remove('is-invalid');
          } else {
            input.classList.add('is-invalid');
          }
        }
      });
    }, false);
  })();
</script>

<script>
  const hasVariations = document.getElementById('has_variations');
  const variationsContainer = document.getElementById("variations_container");
  const noVariationsContainer = document.getElementById("no_variations_container");
  const optionsContainer = document.getElementById("options_container");
  const hiddenOptionCount = document.getElementById("option_count_hidden");
  let optionsCount = 1;

  // * For creating HTML Elements from strings
  function fromHTML(html, trim = true) {
    // Process the HTML string.
    html = trim ? html.trim() : html;
    if (!html) return null;

    // Then set up a new template element.
    const template = document.createElement('template');
    template.innerHTML = html;
    const result = template.content.children;

    // Then return either an HTMLElement or HTMLCollection,
    // based on whether the input HTML had one or more roots.
    if (result.length === 1) return result[0];
    return result;
  }

  // * Toggle required attribute
  function toggleRequired(container, required) {
    const inputs = container.querySelectorAll('input');
    for (let i = 0; i < inputs.length; i++) {
      inputs[i].required = required;
    }
  }

  // * Variation Toggle
  hasVariations.addEventListener("change", () => {
    if (hasVariations.checked) {
      variationsContainer.classList.remove("d-none");
      noVariationsContainer.classList.add("d-none");

      toggleRequired(noVariationsContainer, false);
      toggleRequired(variationsContainer, true);
    } else {
      variationsContainer.classList.add("d-none");
      noVariationsContainer.classList.remove("d-none");

      toggleRequired(noVariationsContainer, true);
      toggleRequired(variationsContainer, false);
    }
  })

  // * Update Remove Button Status
  function updateRemoveButtonStatus() {
    const removeButtons = optionsContainer.querySelectorAll('.remove-option-btn');
    for (let i = 0; i < removeButtons.length; i++) {
      removeButtons[i].disabled = (i !== removeButtons.length - 1); // Disable all but the last button
    }
  }

  // * Add Variation Option
  function handleAddOption() {
    optionsCount += 1;
    hiddenOptionCount.value = optionsCount

    const optionElement = fromHTML(`
<div id="option_${optionsCount}" class="mb-3 p-3 option-custom-container">
  <div class="row row-cols-2">
    <div class="col-10">
      <div class="mb-3">
        <label for="option_name_${optionsCount}">Option ${optionsCount} Name</label>
        <input type="text" name="option_name_${optionsCount}" id="option_name_${optionsCount}" class="form-control" style="background-color: white;" placeholder="Small, Medium, etc..." required>
        <div class="invalid-feedback">
          Please provide Option ${optionsCount} Name.
        </div>
      </div>
      <div class="mb-3">
        <label for="option_price_${optionsCount}">Price</label>
        <div class="input-group">
          <span class="input-group-text">₱</span>
          <input type="number" name="option_price_${optionsCount}" id="option_price_${optionsCount}" class="form-control" style="background-color: white;" required>
          <div class="invalid-feedback">
            Please provide Option ${optionsCount} Price.
          </div>
        </div>
      </div>
      <div>
        <label for="option_stock_${optionsCount}">Stock</label>
        <input type="number" name="option_stock_${optionsCount}" id="option_stock_${optionsCount}" class="form-control" style="background-color: white;" required>
        <div class="invalid-feedback">
          Please provide Option ${optionsCount} Stock.
        </div>
      </div>
    </div>
    <div class="col-2 d-flex align-items-center justify-content-center">
      <button type="button" class="btn btn-danger remove-option-btn" onclick="handleRemoveOption()" style="height: 50px;" aria-label="Remove"><i class="bi bi-x-lg"></i></button>
    </div>
  </div>
</div>
    `)

    optionsContainer.appendChild(optionElement);
    updateRemoveButtonStatus();
  }

  // * Add Variation Option
  function handleRemoveOption() {
    let optionParentEl = document.getElementById(`option_${optionsCount}`);
    optionParentEl.innerHTML = "";
    optionParentEl.remove();
    updateRemoveButtonStatus();
    optionsCount--;
    hiddenOptionCount.value = optionsCount;
  }
</script>

<?= $this->endSection() ?>