<?php

// Standalone checks for the helpers. Run with: php tests/helpers_test.php
require __DIR__ . '/../includes/helpers/text.php';
require __DIR__ . '/../includes/cart/totals.php';

$fail = 0;
function check($label, $got, $want)
{
    global $fail;
    $ok = $got === $want;
    if (!$ok) { $fail++; }
    echo ($ok ? 'PASS' : 'FAIL') . " $label\n";
}

check('slugify', slugify('Blue T Shirt!'), 'blue-t-shirt');
check('escape', escapeHtml('<b>'), '&lt;b&gt;');
check('subtotal', cartSubtotal([['price' => 10, 'qty' => 2], ['price' => 5, 'qty' => 1]]), 25.0);
check('shipping under 50', cartShipping(25.0), 3.0);
check('shipping over 50', cartShipping(80.0), 0.0);

echo $fail === 0 ? "all passed\n" : "$fail failed\n";
exit($fail === 0 ? 0 : 1);
