<?php

// Stock helpers used around the cart and product pages.
function isLowStock(int $available, int $threshold = 5): bool
{
    return $available > 0 && $available <= $threshold;
}

function isOutOfStock(int $available): bool
{
    return $available <= 0;
}

// Never let a requested quantity exceed what's in stock.
function clampQuantity(int $requested, int $available): int
{
    if ($requested < 1) {
        return 1;
    }
    return min($requested, max(0, $available));
}
