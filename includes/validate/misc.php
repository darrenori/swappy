<?php

// Singapore postal codes are 6 digits.
function isValidPostalSg(string $zip): bool
{
    return (bool) preg_match('/^\d{6}$/', $zip);
}

// Luhn check for a card number, run before we bother storing anything.
function luhnCheck(string $number): bool
{
    $number = preg_replace('/\D+/', '', $number);
    if ($number === '') {
        return false;
    }
    $sum = 0;
    $alt = false;
    for ($i = strlen($number) - 1; $i >= 0; $i--) {
        $n = (int) $number[$i];
        if ($alt) {
            $n *= 2;
            if ($n > 9) {
                $n -= 9;
            }
        }
        $sum += $n;
        $alt = !$alt;
    }
    return $sum % 10 === 0;
}
