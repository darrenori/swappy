<?php
// validate card number using regex
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
function validatecard($number)
{
  global $type;
  if (!isset($_SESSION)) {
    session_start();
  }
  session_regenerate_id();

  $cardtype = array(
    "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
    "mastercard" => "/^5[1-5][0-9]{14}$/",
    "amex"       => "/^3[47][0-9]{13}$/",
    "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
  );

  if (preg_match($cardtype['visa'], $number)) {
    $type = "visa";
    return 'visa';
  } else if (preg_match($cardtype['mastercard'], $number)) {
    $type = "mastercard";
    return 'mastercard';
  } else if (preg_match($cardtype['amex'], $number)) {
    $type = "amex";
    return 'amex';
  } else if (preg_match($cardtype['discover'], $number)) {
    $type = "discover";
    return 'discover';
    $type = $_SESSION["type"];
  } else {
    return 'false';
  }
}
### !!!! WHat is the purpose of colling this function here? zeph 
// validatecard($number);

// validate card number using mod 10
function luhn_check($number)
{

  // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
  $number = preg_replace('/\D/', '', $number);

  // Set the string length and parity
  $number_length = strlen($number);
  $parity = $number_length % 2;

  // Loop through each digit and do the maths
  $total = 0;
  for ($i = 0; $i < $number_length; $i++) {
    $digit = $number[$i];
    // Multiply alternate digits by two
    if ($i % 2 == $parity) {
      $digit *= 2;
      // If the sum is two digits, add them together (in effect)
      if ($digit > 9) {
        $digit -= 9;
      }
    }
    // Total up the digits
    $total += $digit;
  }

  // If the total mod 10 equals 0, the number is valid
  return ($total % 10 == 0) ? TRUE : FALSE;
}
