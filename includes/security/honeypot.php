<?php

// A hidden field bots tend to fill in. Drop honeypotField() into a form and check
// honeypotTriggered() when it comes back.
function honeypotField(string $name = 'website'): string
{
    return '<input type="text" name="' . htmlspecialchars($name) . '" value="" '
         . 'style="position:absolute;left:-9999px" tabindex="-1" autocomplete="off">';
}

function honeypotTriggered(array $post, string $name = 'website'): bool
{
    return isset($post[$name]) && trim($post[$name]) !== '';
}
