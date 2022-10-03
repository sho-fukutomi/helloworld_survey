<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://script.google.com/macros/s/AKfycbzwfpyFwBaSEGer7ctp2BWh8YK2MNUznlCn8ZzueNpQvoBFFV6zEoP3SNWwU_u5bv9o/exec',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'payload=%7B%22brand%22%3A%22tomitomi%22%2C%22email%22%3A%22i\'ll%20go%20to%20company%20dinner%20now%22%7D',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
