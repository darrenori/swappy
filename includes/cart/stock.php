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
