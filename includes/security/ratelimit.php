<?php

// Session backed login throttle. Call registerFailedLogin() on a bad password and
// isRateLimited() before letting another attempt through. Key it by username or IP.

function isRateLimited(string $key): bool
{
    $entry = $_SESSION['rl'][$key] ?? null;
    if ($entry === null) {
        return false;
    }
    // once the lockout window has passed, forget the old attempts
    if (time() - $entry['first'] > LOGIN_LOCKOUT_SECONDS) {
        unset($_SESSION['rl'][$key]);
        return false;
    }
    return $entry['count'] >= LOGIN_MAX_ATTEMPTS;
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
