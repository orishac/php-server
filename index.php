<?php

if ($_POST['action_type'] == 'handshake') {
    echo 'OK';
}

else if ($_POST['action_type'] == 'pay') {
  if (validatePayment($_POST)){
    if ($_POST['ccv'] == '988'){
      echo -1;
    }
    else if ($_POST['ccv'] == '986'){
      echo 'unexpected-output';
    }
    else if ($_POST['ccv'] == '984'){
      sleep(121);
    }
    else{
      echo rand(10000,100000);
    }
  }
  else
    echo -1;
}

else if ($_POST['action_type'] == 'cancel_pay') {
  if (key_exists('transaction_id' , $_POST))
    echo 1;
  else
    echo -1;
}

else if ($_POST['action_type'] == 'supply') {
  if (validateSupply($_POST))
    echo rand(10000,100000);
  else
    echo -1;
}

else if ($_POST['action_type'] == 'cancel_supply') {
  if (key_exists('transaction_id' , $_POST))
    echo 1;
  else
    echo -1;
}

else if ($_POST['action_type'] == 'fail') {
  echo -1;
}

else if ($_POST['action_type'] == 'error') {
  echo 'unexpected-output';
}

else{
  $GLOBALS['http_response_code'] = 400;
  echo 'error: unrecognized action_type';
}


function validatePayment($array){
  return key_exists('card_number' , $array) && 
      key_exists('month' , $array) &&
      key_exists('year' , $array) &&
      key_exists('holder' , $array) &&
      key_exists('ccv' , $array) &&
      key_exists('id' , $array);
}

function validateSupply($array){
  return key_exists('name' , $array) && 
      key_exists('address' , $array) &&
      key_exists('city' , $array) &&
      key_exists('country' , $array) &&
      key_exists('zip' , $array);
}