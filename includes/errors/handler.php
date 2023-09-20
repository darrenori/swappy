<?php

// Log uncaught errors and exceptions instead of printing them at the user.
function registerErrorHandler(?string $logFile = null): void
{
    $logFile = $logFile ?? __DIR__ . '/../../logs/error.log';

    set_exception_handler(function ($e) use ($logFile) {
        @file_put_contents($logFile, date('c') . "\t" . $e . "\n", FILE_APPEND | LOCK_EX);
        http_response_code(500);
        echo 'Sorry, something went wrong.';
    });

    set_error_handler(function ($no, $str, $file, $line) use ($logFile) {
        @file_put_contents($logFile, date('c') . "\t$str in $file:$line\n", FILE_APPEND | LOCK_EX);
        return true;
    });
}
