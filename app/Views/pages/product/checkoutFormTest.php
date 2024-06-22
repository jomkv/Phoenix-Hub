<?php helper('form'); ?>

<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Checkout Form <?= $this->endSection() ?>

<?= $this->section("content") ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">

<div class="container pb-4" style="margin-top: 150px;">

  <h1>Phoenix Hub | Checkout</h1>
  <div class="bg-white shadow-lg p-5 w-100">
    <h4>Order Details</h4>
    <table class="table table-bordered table-hover rounded w-100">
      <thead>
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
          <td style="height: 50px">
            <img src="<?= base_url() . 'phoenix.png' ?>" class="img-fluid rounded-start mb-2" style="object-fit: scale-down; width: 50px;" alt="Product Image">
          </td>
          <td class="text-center">
            Test Prod
          </td>
          <td class="text-center">₱1234</td>
          <td class="text-center">12</td>
          <td class="text-center">₱12345</td>
        </tr>
        <tr>
          <td colspan="3">

          </td>
          <td class="text-end">
            Total:
          </td>
          <td class="text-center fw-bold">₱123456</td>
        </tr>
      </tbody>
    </table>
  </div>

  <form class="mt-5 bg-white shadow-lg rounded p-5 pb-2 mb-4">
    <h4>Pickup and Payment Details</h4>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Payment Method</label>
      <select id="payment_method" name="payment_method" class="form-select">
        <option value="cod" selected>Pay Cash on Pickup</option>
        <option value="online">Pay Online in Advance</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="pickup_date" class="form-label">Date</label>
      <input name="pickup_date" id="pickup_date" class="form-control bg-white" placeholder="YYYY-MM-DD" data-input value="<?= old("pickup_date") ?>" />
    </div>
    <div class="mb-5">
      <label for="pickup_time" class="form-label">Time</label>
      <input name="pickup_time" class="form-control bg-white" id="pickup_time" placeholder="HH:MM" value="<?= old("pickup_time") ?>">
    </div>
    <h4 class="mb-3">Terms and Conditions</h4>

    <ul class="mb-3">
      <li>Upon submission of your order, you will receive an acknowledgment email. However, please note that this does not guarantee order confirmation. Our team will review your order and confirm its availability and processing. You will be notified via email if your order is confirmed or canceled.</li>
      <li>Once your order is picked up and paid for, refunds will not be processed. We encourage you to carefully review your order details before confirming it.</li>
      <li>All orders must be picked up at the designated location: CvSU SIlang Gymnasium. We do not offer alternative pick-up locations at this time.</li>
    </ul>

    <div class="mb-3 ml-2 form-check">
      <input type="checkbox" class="form-check-input pl-2" id="terms_accept">
      <label class="form-check-label" for="terms_accept">Do you agree?</label>
    </div>
    <div class="bg-danger-subtle text-dark border-danger border-start border-4 rounded" style="padding: 10px; padding-left: 15px;">
      <h4 class="fw-bold">Something went wrong</h4>
      <ul>
        <li class="fw-medium">Test Error 1</li>
        <li class="fw-medium">Test Error 2</li>
        <li class="fw-medium">Test Error 3</li>
      </ul>
    </div>
    <div class="text-center mt-4">
      <button type="submit" class="btn btn-primary pt-3 pb-3 pl-4 pr-4 fw-bold">Submit Order</button>
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
  })

  $(document).ready(function() {
    // Get the checkbox and submit button elements
    const termsCheckbox = $('#terms_accept');
    const submitButton = $('button[type="submit"]');

    // Check the initial state (disable if unchecked)
    if (!termsCheckbox.is(':checked')) {
      submitButton.prop('disabled', true);
    }
  });
</script>



<?= $this->endSection() ?>