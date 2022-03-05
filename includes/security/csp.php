<?php

// Build and send a Content-Security-Policy header.
function buildCsp(array $overrides = []): string
{
    $policy = array_merge([
        'default-src' => "'self'",
        'img-src'     => "'self' data:",
        'style-src'   => "'self' 'unsafe-inline'",
        'script-src'  => "'self' https://www.google.com https://www.gstatic.com", // recaptcha
        'frame-src'   => "https://www.google.com",
        'object-src'  => "'none'",
        'base-uri'    => "'self'",
    ], $overrides);

    $parts = [];
    foreach ($policy as $directive => $value) {
        $parts[] = $directive . ' ' . $value;
    }
    return implode('; ', $parts);
}

function sendCsp(array $overrides = []): void
{
    if (!headers_sent()) {
        header('Content-Security-Policy: ' . buildCsp($overrides));
    }
}
