<?php

// Tiny reader for a local .env file (KEY=value lines). The app still reads the DB login
// from includes/dbh.inc.php; this is for the extras like mail settings.

function envGet(string $key, $default = null)
{
    static $vars = null;
    if ($vars === null) {
        $vars = [];
        $path = __DIR__ . '/../.env';
        if (is_readable($path)) {
            foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                $line = trim($line);
                if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
                    continue;
                }
                [$k, $v] = explode('=', $line, 2);
                $vars[trim($k)] = trim($v);
            }
        }
    }
    return array_key_exists($key, $vars) ? $vars[$key] : $default;
}
