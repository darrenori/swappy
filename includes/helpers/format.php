<?php

// Money formatting. Prices are stored as a number; show them as $x.xx.
function formatPrice($amount, string $symbol = '$'): string
{
    return $symbol . number_format((float) $amount, 2);
}
