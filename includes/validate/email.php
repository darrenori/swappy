<?php

// Stricter email check: valid format plus a domain that actually resolves (MX or A).
function isValidEmailStrict(string $email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    $at = strrchr($email, '@');
    $domain = $at === false ? '' : substr($at, 1);
    if ($domain === '') {
        return false;
    }
    return checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A');
}
