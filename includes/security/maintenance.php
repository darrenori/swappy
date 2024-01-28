<?php

// Flip a file to put the site into maintenance mode. If storage/maintenance.flag exists,
// everyone except the listed admin IPs gets a friendly 503.
function maintenanceGate(array $allowIps = []): void
{
    $flag = __DIR__ . '/../../storage/maintenance.flag';
    if (!is_file($flag)) {
        return;
    }
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    if (in_array($ip, $allowIps, true)) {
        return;
    }
    http_response_code(503);
    header('Retry-After: 3600');
    echo 'SWAP is down for maintenance. Please check back soon.';
    exit;
}
