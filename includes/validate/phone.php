<?php

// Normalise a Singapore phone number to 8 digits, or null if it doesn't look right.
function normalisePhoneSg(string $input): ?string
{
    $digits = preg_replace('/\D+/', '', $input);
    // drop a +65 / 65 country code if present
    if (strlen($digits) === 10 && strpos($digits, '65') === 0) {
        $digits = substr($digits, 2);
    }
    if (strlen($digits) === 8 && preg_match('/^[3689]/', $digits)) {
        return $digits;
    }
    return null;
}
