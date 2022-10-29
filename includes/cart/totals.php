<?php

// Add up a cart. $items is an array of ['price' => .., 'qty' => ..].
function cartSubtotal(array $items): float
{
    $subtotal = 0.0;
    foreach ($items as $item) {
        $subtotal += ((float) $item['price']) * max(0, (int) $item['qty']);
    }
    return round($subtotal, 2);
}

function cartShipping(float $subtotal): float
{
    // free over $50, flat $3 otherwise, nothing on an empty cart
    if ($subtotal <= 0) {
        return 0.0;
    }
    return $subtotal >= 50 ? 0.0 : 3.0;
}

function cartTotal(array $items): float
{
    $subtotal = cartSubtotal($items);
    return round($subtotal + cartShipping($subtotal), 2);
}
