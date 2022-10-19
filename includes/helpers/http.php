<?php

// Redirect helper and one-shot flash messages kept in the session.
function redirectTo(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function flashSet(string $key, string $message): void
{
    $_SESSION['_flash'][$key] = $message;
}

function flashGet(string $key): ?string
{
    if (!isset($_SESSION['_flash'][$key])) {
        return null;
    }
    $msg = $_SESSION['_flash'][$key];
    unset($_SESSION['_flash'][$key]);
    return $msg;
}
