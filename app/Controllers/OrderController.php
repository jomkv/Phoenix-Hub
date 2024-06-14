<?php

namespace App\Controllers;

//use App\Models\OrganizationModel;

class OrderController extends BaseController
{

  public function pay()
  {

    $apiKey = getenv('paymongo.secret');

    if (!$apiKey) {
      log_message('error', 'Payment error: API key not set.');
      session()->setFlashdata('error', 'Payment error: API key not set.');
      return redirect()->to(site_url('error'));
    }

    $data = [
      'data' => [
        'attributes' => [
          'line_items' => [
            [
              'currency'      => 'PHP',
              'amount'        => 10000,
              'description'   => 'Test Product',
              'name'          => 'Test Product',
              'quantity'      => 1,
            ]
          ],
          'payment_method_types' => [
            'card',
            'paymaya',
            'gcash',
            'grab_pay',
          ],
          'success_url' => url_to('OrderController::success'),
          'cancel_url' => url_to('OrderController::cancel'),
          'description' => 'Payment for Test Product'
        ],
      ]
    ];


    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => 'https://api.paymongo.com/v1/checkout_sessions',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($apiKey)
      ]
    ]);

    $response = curl_exec($curl);


    if ($curlError = curl_error($curl)) {
      curl_close($curl);
      log_message('error', 'cURL error: ' . $curlError);
      session()->setFlashdata('error', 'Payment error: ' . $curlError);
      return redirect()->to(site_url('error'));
    }


    curl_close($curl);


    $responseData = json_decode($response);


    if (isset($responseData->data->id)) {

      session()->set('session_id', $responseData->data->id);


      $checkoutUrl = $responseData->data->attributes->checkout_url ?? null;
      if ($checkoutUrl) {
        return redirect()->to($checkoutUrl);
      } else {

        session()->setFlashdata('error', 'Payment error: Checkout URL not available.');
        return redirect()->to(site_url('error'));
      }
    } else {

      $errorMessage = isset($responseData->errors) ? json_encode($responseData->errors) : 'Unknown error';
      log_message('error', 'Payment error: ' . $errorMessage);
      session()->setFlashdata('error', 'Payment error: ' . $errorMessage);
      return redirect()->to(site_url('error'));
    }
  }

  public function success()
  {
    $sessionId = session()->get('session_id');

    if ($sessionId) {
      $curl = curl_init();
      curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.paymongo.com/v1/checkout_sessions/' . $sessionId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
          'Authorization: Basic ' . base64_encode(getenv('paymongo.secret'))
        ]
      ]);
      $response = curl_exec($curl);
      curl_close($curl);
      $responseData = json_decode($response);
      dd($responseData);
    } else {
      session()->setFlashdata('error', 'Session ID not found.');
      return redirect()->to(site_url('error'));
    }
  }

  public function cancel()
  {
    dd("cancel");
  }
}
