<?php

// Random token generation and constant-time comparison, for CSRF, OTP links and the like.
function randomToken(int $bytes = 32): string
{
    return bin2hex(random_bytes($bytes));
}

function compareTokens(string $known, string $given): bool
{
    return hash_equals($known, $given);
}
