<?php

// Session backed login throttle. Call registerFailedLogin() on a bad password and
// isRateLimited() before letting another attempt through. Key it by username or IP.

function isRateLimited(string $key): bool
{
    $attempts = $_SESSION['rl'][$key]['count'] ?? 0;
    return $attempts >= LOGIN_MAX_ATTEMPTS;
}

function registerFailedLogin(string $key): void
{
    if (!isset($_SESSION['rl'][$key])) {
        $_SESSION['rl'][$key] = ['count' => 0, 'first' => time()];
    }
    $_SESSION['rl'][$key]['count']++;
}

function clearRateLimit(string $key): void
{
    unset($_SESSION['rl'][$key]);
}
