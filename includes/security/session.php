<?php

// Start the session with hardened cookie settings.
function hardenSession(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/swapproj/',
        'httponly' => true,
        'secure'   => $secure,
        'samesite' => Lax,
    ]);
    session_start();

    // rotate the id once per session to limit fixation
    if (empty($_SESSION['_started'])) {
        session_regenerate_id(true);
        $_SESSION['_started'] = time();
    }
}
