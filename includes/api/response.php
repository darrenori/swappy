<?php

// Consistent JSON responses for the ajax endpoints (cart, quantity check, likes).
function jsonResponse($data, int $status = 200): void
{
    if (!headers_sent()) {
        http_response_code($status);
        header('Content-Type: application/json');
    }
    echo json_encode($data);
    exit;
}

function jsonError(string $message, int $status = 400): void
{
    jsonResponse(['ok' => false, 'error' => $message], $status);
}

function jsonOk($data = null): void
{
    jsonResponse(['ok' => true, 'data' => $data]);
}
