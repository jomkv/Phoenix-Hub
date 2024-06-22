<?php helper('form'); ?>

<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Checkout Form <?= $this->endSection() ?>

<?= $this->section("content") ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">

<style>
  h1, h4 {
    color: #333;
  }

  .bg-white {
    background-color: #fff !important;
  }

  .shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
  }

  .form-label {
    font-weight: bold;
  }

  .form-control {
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
  }

  .table th, .table td {
    vertical-align: middle;
  }

  .form-check-input {
    margin-left: 0;
    width: 1.25rem;
    height: 1.25rem;
  }

  .form-check-label {
    margin-left: .5rem;
    font-weight: bold;
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
  <div class="bg-white shadow-lg p-5 w-100 mb-5">
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
        <tbody>
          <tr>
            <td class="text-center" style="height: 50px;">
              <img src="<?= base_url() . 'phoenix.png' ?>" class="img-fluid rounded-start mb-2 mx-auto d-block" style="object-fit: scale-down; width: 50px;" alt="Product Image">
            </td>
            <td class="text-center">Test Prod</td>
            <td class="text-center">₱1234</td>
            <td class="text-center">12</td>
            <td class="text-center">₱12345</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td class="text-end">Total:</td>
            <td class="text-center fw-bold">₱123456</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <form class="mt-5 shadow-lg rounded p-5 pb-2 mb-4" style="background-color: #adb5bd;">
    <h4>Pickup and Payment Details</h4>
    <div class="mb-3">
      <label for="payment_method" class="form-label">Payment Method</label>
      <select id="payment_method" name="payment_method" class="form-select">
        <option value="cod" selected>Pay Cash on Pickup</option>
        <option value="online">Pay Online in Advance</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="pickup_date" class="form-label">Date</label>
      <input name="pickup_date" id="pickup_date" class="form-control bg-white" placeholder="YYYY-MM-DD" data-input value="<?= old("pickup_date") ?>" />
    </div>
    <div class="mb-3">
  <label for="pickup_time" class="form-label">Pickup Time</label>
  <select name="pickup_time" class="form-select" id="pickup_time">
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
</div>

    <h4 class="mb-3">Terms and Conditions</h4>

    <div class="terms-conditions mb-3">
      <ul>
        <li>Upon submission of your order, you will receive an acknowledgment email. However, please note that this does not guarantee order confirmation. Our team will review your order and confirm its availability and processing. You will be notified via email if your order is confirmed or canceled.</li>
        <li>Once your order is picked up and paid for, refunds will not be processed. We encourage you to carefully review your order details before confirming it.</li>
        <li>All orders must be picked up at the designated location: CvSU SIlang Gymnasium. We do not offer alternative pick-up locations at this time.</li>
      </ul>
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="terms_accept">
      <label class="form-check-label" for="terms_accept">Do you agree?</label>
    </div>

    <div class="alert alert-danger bg-danger-subtle text-dark border-danger border-start border-4 rounded">
      <h4 class="fw-bold">Something went wrong</h4>
      <ul>
        <li class="fw-medium">Test Error 1</li>
        <li class="fw-medium">Test Error 2</li>
        <li class="fw-medium">Test Error 3</li>
      </ul>
    </div>

    <div class="text-center mt-4">
      <button type="submit" class="btn btn-primary" disabled>Submit Order</button>
    </div>
  </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>

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

    termsCheckbox.on('change', function() {
      submitButton.prop('disabled', !this.checked);
    });

    if (!termsCheckbox.is(':checked')) {
      submitButton.prop('disabled', true);
    }
  });
</script>

<?= $this->endSection() ?>
