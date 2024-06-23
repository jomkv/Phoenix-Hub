<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Edit Product <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="text-center">
  <div class="container text-start">
    <form class="needs-validation" novalidate enctype="multipart/form-data" method="post" action="<?= base_url() . 'admin/product/' . $product->product_id ?>">
      <div class="row mt-4 mb-5">
        <input type="hidden" id="option_count_hidden" value="<?= $product->has_variations === "0" ? 1 : count($variations) ?>" name="option_count_hidden">
        <div class="col-12 d-flex justify-content-center">
          <div class="w-75">
            <h1>Edit Product - [Product ID: <?= $product->product_id ?>]</h1>
          </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
          <div class="custom_form_container shadow-lg p-4 card-custom-container">
            <h3 class="mb-3">Basic information</h3>

            <!-- PRODUCT ORG -->
            <div class="mb-3">
              <label for="organization_id">Organization</label>
              <select name="organization_id" id="organization_id" class="form-select" style="background-color: white;">
                <?php foreach ($organizations as $org) : ?>
                  <option value="<?= $org->organization_id; ?>" <?= $org->organization_id === $product->organization_id ? 'selected="selected"' : '' ?>><?= esc($org->name) ?></option>
                <?php endforeach ?>
              </select>
            </div>

            <!-- PRODUCT NAME -->
            <div class="mb-3">
              <label for="product_name">Product Name</label>
              <input type="text" name="product_name" id="product_name" class="form-control" style="background-color: white;" value="<?= esc(old('product_name', $product->product_name)) ?>" required>
              <div class="invalid-feedback">
                Please provide a product name.
              </div>
            </div>


            <!-- DESCRIPTION -->
            <div class="mb-3">
              <label for="description">Description</label>
              <textarea type="text" name="description" id="description" class="form-control" style="background-color: white; resize: none;" rows="4" required><?= esc(old('description', $product->description)) ?></textarea>
              <div class="invalid-feedback">
                Please provide a description.
              </div>
            </div>

            <!-- IMAGES -->
            <div class="mb-3">
              <label for="formFileMultiple" class="form-label">Image(s)</label>
              <input type="file" name="fileuploads[]" class="form-control" accept="image/*" multiple>
              <div class="form-text">
                If no image is provided, the product will keep using its currently set images.
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 d-flex justify-content-center mt-4">
          <div class="custom_form_container shadow-lg p-4 card-custom-container">
            <h3 class="mb-3">Sales information</h3>

            <!-- VARIATIONS CHECKBOX -->
            <div class="form-check form-switch mb-3">
              <input class="form-check-input" type="checkbox" role="switch" name="has_variations" id="has_variations" value="has_variations" <?= $product->has_variations === "1" ? "checked" : "" ?>>
              <label class="form-check-label" for="has_variations">Product Variations</label>
            </div>

            <!-- VARIATION NAME -->
            <div id="variations_container" class="<?= $product->has_variations === "1" ? "" : "d-none" ?>">
              <div class="mb-3">
                <label for="variation_name">Variation Name</label>
                <input type="text" name="variation_name" id="variation_name" class="form-control" style="background-color: white;" placeholder="Sizes" value="<?= esc(old('variation_name', $product->variation_name)) ?>">
                <div class="invalid-feedback">
                  Please provide a variation name.
                </div>
              </div>
              <div id="options_container" class="">
                <?php if ($product->has_variations === "1") :
                  $count = 1;
                  foreach ($variations as $option) :
                ?>
                    <div id="option_<?= $count ?>" class="mb-3 p-3 option-custom-container">
                      <div class="row row-cols-2">
                        <div class="col-10">
                          <input type="hidden" id="option_id_<?= $count ?>" value="<?= $option->variation_id ?? "null" ?>" name="option_id_<?= $count ?>">

                          <!-- OPTION NAME -->
                          <div class="mb-3">
                            <label for="option_name_<?= $count ?>">Option <?= $count ?> Name</label>
                            <input type="text" name="option_name_<?= $count ?>" id="option_name_<?= $count ?>" class="form-control" style="background-color: white;" placeholder="Small, Medium, etc..." value="<?= esc(old("option_name_" . $count, $option->option_name)) ?>">
                            <div class="invalid-feedback">
                              Please provide Option <?= $count ?> Name.
                            </div>
                          </div>

                          <!-- PRICE -->
                          <div class="mb-3">
                            <label for="option_price_<?= $count ?>">Price</label>
                            <div class="input-group">
                              <span class="input-group-text">₱</span>
                              <input type="number" name="option_price_<?= $count ?>" id="option_price_<?= $count ?>" class="form-control" style="background-color: white;" min="1" value="<?= esc(old("option_price_" . $count, $option->price)) ?>">
                              <div class="invalid-feedback">
                                Please provide Option <?= $count ?> Price.
                              </div>
                            </div>
                          </div>

                          <!-- STOCK -->
                          <div>
                            <label for="option_stock_<?= $count ?>">Stock</label>
                            <input type="number" name="option_stock_<?= $count ?>" id="option_stock_<?= $count ?>" class="form-control" style="background-color: white;" value="<?= esc(old("option_stock_" . $count, $option->stock)) ?>">
                            <div class="invalid-feedback">
                              Please provide Option <?= $count ?> Stock.
                            </div>
                          </div>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-center">
                          <button type="button" class="btn btn-danger <?= $count === 1 ? "" : "remove-option-btn" ?> " <?= $count !== count($variations) ? "disabled" : "" ?> style="height: 50px;" aria-label="Remove" onclick="handleRemoveOption()"><i class="bi bi-x-lg"></i></button>
                        </div>
                      </div>
                    </div>
                  <?php $count++;
                  endforeach;
                else :
                  ?>
                  <div id="option_1" class="mb-3 p-3 option-custom-container">
                    <div class="row row-cols-2">
                      <div class="col-10">
                        <input type="hidden" id="option_id_${optionsCount}" value="null" name="option_id_1">

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
                            <input type="number" name="option_price_1" min="1" id="option_price_1" class="form-control" style="background-color: white;">
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
                <?php endif; ?>
              </div>

              <!-- SUBMIT -->
              <button type="button" onclick="handleAddOption()" class="mb-3 p-3 option-custom-container add-option-container w-100">
                <i class="bi bi-plus-lg"></i> Add Option
              </button>
            </div>

            <div id="no_variations_container" class="<?= $product->has_variations === "0" ? "" : "d-none" ?>">
              <div class="mb-3 ">
                <label for="price">Price</label>
                <div class="input-group">
                  <span class="input-group-text">₱</span>
                  <input type="number" name="price" id="price" class="form-control" min="1" style="background-color: white;" value="<?= esc(old('price', $product->has_variations === "0" ? $product->price : null)) ?>" <?= $product->has_variations === "0" ? "required" : "" ?>>
                  <div class="invalid-feedback">
                    Please provide a product price.
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" style="background-color: white;" value="<?= esc(old('stock', $product->has_variations === "0" ? $product->stock : null)) ?>" <?= $product->has_variations === "0" ? "required" : "" ?>>
                <div class="invalid-feedback">
                  Please provide a product stock.
                </div>
              </div>
            </div>

            <a href="<?= url_to("AdminViewController::viewProducts") ?>" class="btn btn-danger w-100 mb-3 fs-6 fw-bold pt-3 pb-3">Discard Changes</a>
            <button type="submit" class="btn btn-primary w-100 mb-3 fs-6 fw-bold pt-3 pb-3">Save Changes</button>

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
  let optionsCount = <?= $product->has_variations === "1" ? count($variations) : 1 ?>;

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
      <input type="hidden" id="option_id_${optionsCount}" value="null" name="option_id_${optionsCount}">

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
          <input type="number" name="option_price_${optionsCount}" min="1" id="option_price_${optionsCount}" class="form-control" style="background-color: white;" required>
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