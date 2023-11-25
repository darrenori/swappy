<?php

// Standalone checks for the validators. Run with: php tests/validate_test.php
require __DIR__ . '/../includes/validate/phone.php';
require __DIR__ . '/../includes/validate/misc.php';

$fail = 0;
function check($label, $got, $want)
{
    global $fail;
    $ok = $got === $want;
    if (!$ok) { $fail++; }
    echo ($ok ? 'PASS' : 'FAIL') . " $label\n";
}

check('sg phone +65', normalisePhoneSg('+65 9123 4567'), '91234567');
check('sg phone bad', normalisePhoneSg('12345'), null);
check('postal ok', isValidPostalSg('238801'), true);
check('postal bad', isValidPostalSg('12ab56'), false);
check('luhn ok', luhnCheck('4539578763621486'), true);
check('luhn bad', luhnCheck('1234567890123456'), false);

echo $fail === 0 ? "all passed\n" : "$fail failed\n";
exit($fail === 0 ? 0 : 1);
