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
        <?php $total = 0; ?>
        <?php foreach ($cartItems as $item) : ?>
          <?php
          $cartItemTotal = 0;

          if ($item['cartItem']->is_variant) {
            $cartItemTotal = $item["variant"]->price * $item['cartItem']->quantity;
          } else {
            $cartItemTotal = $item['product']->price * $item['cartItem']->quantity;
          }

          $total += $cartItemTotal;
          ?>
          <tr>
            <td style="height: 50px">
              <img src="<?= json_decode($item['product']->images)[0]->url ?>" class="img-fluid rounded-start mb-2" style="object-fit: scale-down; width: 50px;" alt="Product Image">
            </td>
            <td class="text-center">
              <?= esc($item['product']->product_name) ?>
              <?php if ($item['cartItem']->is_variant && $item['product']->has_variations) : ?>
                <div class="card-title">[<?= esc($item["product"]->variation_name) . ": " . esc($item["variant"]->option_name) ?>]</div>
              <?php endif; ?>
            </td>
            <td class="text-center">
              <?php if ($item['cartItem']->is_variant) : ?>
                <?= "₱" . $item['variant']->price ?>
              <?php else : ?>
                <?= "₱" . $item['product']->price ?>
              <?php endif; ?>
            </td>
            <td class="text-center"><?= $item['cartItem']->quantity ?></td>
            <td class="text-center">₱<?= $cartItemTotal ?></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="3">

          </td>
          <td class="text-end">
            Total:
          </td>
          <td class="text-center fw-bold">₱<?= $total ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <?= form_open('/cart/checkout', ['class' => 'mt-5 bg-white shadow-lg rounded p-5 pb-2 mb-4']) ?>
  <h4>Pickup and Payment Details</h4>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Payment Method</label>
    <select id="payment_method" name="payment_method" class="form-select">
      <option value="cod" selected>Pay Cash on Pickup</option>
      <option value="online" <?= $total < 20 ? "disabled" : "" ?>>Pay Online in Advance</option>
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

  <ul class="mb-3" id="cod_payment_terms">
    <li>Upon submission of your order, you will receive an acknowledgment email. However, please note that this does not guarantee order confirmation. Our team will review your order and confirm its availability and processing. You will be notified via email if your order is confirmed or canceled.</li>
    <li>Once your order is picked up and paid for, refunds will not be processed. We encourage you to carefully review your order details before confirming it.</li>
    <li>All orders must be picked up at the designated location: CvSU SIlang Gymnasium. We do not offer alternative pick-up locations at this time.</li>
  </ul>
  <ul class="mb-3" id="online_payment_terms">
    <li>Order will automatically be confirmed upon successful payment processing.</li>
    <li>If the online payment fails, your order will be automatically cancelled, and you will be notified via email</li>
    <li>Once your order is picked up and paid for, refunds will not be processed. We encourage you to carefully review your order details before confirming it.</li>
    <li>All orders must be picked up at the designated location: CvSU SIlang Gymnasium. We do not offer alternative pick-up locations at this time.</li>
  </ul>

  <div class="mb-3 ml-2 form-check">
    <input type="checkbox" class="form-check-input pl-2" id="terms_accept">
    <label class="form-check-label" for="terms_accept">Do you agree?</label>
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
    <button type="submit" class="btn btn-primary pt-3 pb-3 pl-4 pr-4 fw-bold">Submit Order</button>
  </div>
  <?= form_close(); ?>
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

    // Update button state on checkbox change
    termsCheckbox.change(function() {
      submitButton.prop('disabled', !$(this).is(':checked'));
    });

    const onlineTerms = $('#online_payment_terms');
    const codTerms = $('#cod_payment_terms');
    const paymentMethodSelect = $('#payment_method');

    // Initially hide both online and COD specific terms
    onlineTerms.hide();

    // Show terms based on selected payment method
    paymentMethodSelect.change(function() {
      const selectedMethod = $(this).val();

      if (selectedMethod === 'online') {
        onlineTerms.show();
        codTerms.hide();
      } else if (selectedMethod === 'cod') {
        onlineTerms.hide();
        codTerms.show();
      }
    });
  });
</script>



<?= $this->endSection() ?>