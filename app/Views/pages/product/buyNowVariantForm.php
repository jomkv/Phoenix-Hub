<?php helper('form'); ?>

<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Checkout Form <?= $this->endSection() ?>

<?= $this->section("content") ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">

<style>
  h1,
  h4 {
    color: #333;
  }

  .bg-white {
    background-color: #fff !important;
  }

  .shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
  }

  .form-label {
    font-weight: bold;
  }

  .form-control {
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
  }

  .table th,
  .table td {
    vertical-align: middle;
  }

  .terms-conditions {
    border: 1px solid #dee2e6;
    padding: 10px;
    border-radius: 10px;
    background-color: white;
  }

  .terms-conditions ul {
    margin-bottom: 0;
  }

  .btn-primary {
    padding: .75rem 1.25rem;
    font-size: 1.25rem;
    font-weight: bold;
  }

  .alert-danger {
    padding: 10px;
    border-radius: 5px;
  }
</style>

<div class="container pb-4" style="margin-top: 150px;">
  <h1>Phoenix Hub | Checkout</h1>
  <form class="needs-validation" novalidate method="post" action="<?= base_url() . 'checkout/variant/' . $variant->variation_id ?>">
    <div class="shadow-lg p-5 w-100 mb-5" style="background-color: #faf9f6">
      <h4>Order Details</h4>
      <div class="table-responsive">
        <table class="table table-bordered table-hover rounded w-100">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-center"><i class="bi bi-image"></i></th>
              <th scope="col" class="text-center">Merchandise</th>
              <th scope="col" class="text-center">Unit Price</th>
              <th scope="col" class="text-center">Quantity</th>
              <th scope="col" class="text-center">Item Subtotal</th>
            </tr>
          </thead>
          <tbody style="background-color: white;">
            <tr>
              <td class="text-center" style="height: 50px;">
                <img src="<?= json_decode($product->images)[0]->url ?>" class="img-fluid rounded mb-2 mx-auto d-block" style="object-fit: scale-down; width: 50px;" alt="Product Image">
              </td>
              <td class="text-center">
                <p>
                  <?= esc($product->product_name) ?>
                </p>
                <p>
                  [ <?= esc($product->variation_name) . ": " . esc($variant->option_name) ?> ]
                </p>
              </td>
              <td class="text-center">₱<?= $variant->price ?></td>
              <td class="text-center">
                <input type="hidden" name="quantity" value="<?= $quantity ?>">
                <div class="text-center">
                  <?= esc($quantity) ?>
                </div>
              </td>
              <td class="text-center">₱<?= $variant->price * (int) $quantity ?></td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td class="text-end">Total:</td>
              <td class="text-center fw-bold">₱<?= $variant->price * (int) $quantity ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-5 shadow-lg rounded p-5 pb-2 mb-4" style="background-color: #faf9f6;">
      <h4>Pickup and Payment Details</h4>
      <div class="mb-3">
        <label for="payment_method" class="form-label">Payment Method</label>
        <select id="payment_method" name="payment_method" class="form-select">
          <option value="cod" selected>Pay Cash on Pickup</option>
          <option value="online" <?= ($variant->price * $quantity) < 20 ? "disabled" : "" ?>>Pay Online in Advance</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="pickup_date" class="form-label">Pickup Date</label>
        <input name="pickup_date" autocomplete="off" id="pickup_date" class="form-control bg-white" placeholder="YYYY-MM-DD" data-input value="<?= old("pickup_date") ?>" required />
        <div class="invalid-feedback">
          Please select a valid pickup date.
        </div>
      </div>
      <div class="mb-3">
        <label for="pickup_time" class="form-label">Pickup Time</label>
        <select name="pickup_time" class="form-select" id="pickup_time" required>
          <option selected disabled value="">Choose...</option>
          <option value="09:00">09:00 AM</option>
          <option value="10:00">10:00 AM</option>
          <option value="11:00">11:00 AM</option>
          <option value="12:00">12:00 PM</option>
          <option value="13:00">01:00 PM</option>
          <option value="14:00">02:00 PM</option>
          <option value="15:00">03:00 PM</option>
          <option value="16:00">04:00 PM</option>
          <option value="17:00">05:00 PM</option>
        </select>
        <div class="invalid-feedback">
          Please select a valid pickup time.
        </div>
      </div>

      <h4 class="mb-3">Terms and Conditions</h4>

      <div class="terms-conditions mb-3" id="cod_payment_terms">
        <ul>
          <li>Upon submission of your order, you will receive an acknowledgment email. However, please note that this does not guarantee order confirmation. Our team will review your order and confirm its availability and processing. You will be notified via email if your order is confirmed or canceled.</li>
          <li>Once your order is picked up and paid for, refunds will not be processed. We encourage you to carefully review your order details before confirming it.</li>
          <li>All orders must be picked up at the designated location: CvSU SIlang Gymnasium. We do not offer alternative pick-up locations at this time.</li>
        </ul>
      </div>

      <div class="terms-conditions mb-3" id="online_payment_terms">
        <ul>
          <li>Order will automatically be confirmed upon successful payment processing.</li>
          <li>If the online payment fails, your order will be automatically cancelled, and you will be notified via email</li>
          <li>Once your order is picked up and paid for, refunds will not be processed. We encourage you to carefully review your order details before confirming it.</li>
          <li>All orders must be picked up at the designated location: CvSU SIlang Gymnasium. We do not offer alternative pick-up locations at this time.</li>
        </ul>
      </div>

      <div class="mb-3 form-check bg-success-subtle p-3 pl-5 rounded">
        <input type="checkbox" class="form-check-input" id="terms_accept">
        <label class="form-check-label fw-bold" for="terms_accept">Do you agree?</label>
      </div>

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

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary" disabled>Submit Order</button>
      </div>
    </div>
  </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>

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
  $("#pickup_date").flatpickr({
    dateFormat: "Y-m-d",
    minDate: "today",
    maxDate: new Date().fp_incr(30), // 30 days from now
    "disable": [
      function(date) {
        return (date.getDay() === 0 || date.getDay() === 6); // disable weekends
      }
    ],
    "locale": {
      "firstDayOfWeek": 1 // set start day of week to Monday
    },
  });

  $("#pickup_date").onkeypress = () => false

  $('#pickup_time').flatpickr({
    enableTime: true,
    noCalendar: true,
    minTime: "9:00",
    maxTime: "17:00",
    dateFormat: "H:i"
  });

  $(document).ready(function() {
    const termsCheckbox = $('#terms_accept');
    const submitButton = $('button[type="submit"]');

    termsCheckbox.prop('checked', false);
    submitButton.prop('disabled', true);

    termsCheckbox.on('change', function() {
      submitButton.prop('disabled', !this.checked);
    });

    if (!termsCheckbox.is(':checked')) {
      submitButton.prop('disabled', true);
    }

    const onlineTerms = $('#online_payment_terms');
    const codTerms = $('#cod_payment_terms');
    const paymentMethodSelect = $('#payment_method');

    // Initially hide both online and COD specific terms
    onlineTerms.hide();

    // Show terms based on selected payment method
    paymentMethodSelect.change(function() {
      const selectedMethod = $(this).val();
      termsCheckbox.prop('checked', false);
      submitButton.prop('disabled', true);

      if (selectedMethod === 'online') {
        onlineTerms.show();
        codTerms.hide();
      } else if (selectedMethod === 'cod') {
        onlineTerms.hide();
        codTerms.show();
      }
    })
  });
</script>

<?= $this->endSection() ?>