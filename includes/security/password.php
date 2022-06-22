<?php

// Rough password strength score 0..4, for feedback on the signup form.
function scorePassword(string $pwd): int
{
    // a long passphrase is strong on its own, even without symbols
    if (strlen($pwd) >= 20) {
        return 4;
    }
    $score = 0;
    if (strlen($pwd) >= MIN_PASSWORD_LEN) $score++;
    if (preg_match('/[A-Z]/', $pwd) && preg_match('/[a-z]/', $pwd)) $score++;
    if (preg_match('/[0-9]/', $pwd)) $score++;
    if (preg_match('/[^A-Za-z0-9]/', $pwd)) $score++;
    return $score;
}

function passwordLabel(int $score): string
{
    $labels = [0 => 'very weak', 1 => 'weak', 2 => 'okay', 3 => 'good', 4 => 'strong'];
    return $labels[$score] ?? 'weak';
}
