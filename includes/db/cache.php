<?php

// A dead simple per-request memo, for lookups a page repeats (a store name, say).
function cacheRemember(string $key, callable $producer)
{
    static $store = [];
    if (!array_key_exists($key, $store)) {
        $store[$key] = $producer();
    }
    return $store[$key];
}
