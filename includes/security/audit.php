<?php

// Append a line to the audit log. Mirrors the inline logging the pages already do, but in
// one place so the format stays consistent.
function writeAudit(string $action, ?string $user = null): void
{
    $line = sprintf(
        "%s\t%s\t%s\t%s\n",
        date('c'),
        $_SERVER['REMOTE_ADDR'] ?? '-',
        $user ?? '-',
        $action
    );
    $dir = __DIR__ . '/../../logs';
    if (!is_dir($dir)) {
        @mkdir($dir, 0750, true);
    }
    @file_put_contents($dir . '/audit.log', $line, FILE_APPEND | LOCK_EX);
}
