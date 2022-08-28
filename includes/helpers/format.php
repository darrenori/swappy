<?php

// Money formatting. Prices are stored as a number; show them as $x.xx.
function formatPrice($amount, string $symbol = '$'): string
{
    return $symbol . number_format((float) $amount, 2);
}

// "3 days ago" style relative time from a timestamp or date string.
function timeAgo($when): string
{
    $ts = is_numeric($when) ? (int) $when : strtotime((string) $when);
    $diff = time() - $ts;
    if ($diff < 60) {
        return 'just now';
    }
    $units = [31536000 => 'year', 2592000 => 'month', 86400 => 'day', 3600 => 'hour', 60 => 'minute'];
    foreach ($units as $secs => $name) {
        if ($diff >= $secs) {
            $n = (int) floor($diff / $secs);
            return $n . ' ' . $name . ($n > 1 ? 's' : '') . ' ago';
        }
    }
    return 'just now';
}
