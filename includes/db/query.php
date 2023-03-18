<?php

// Thin wrapper so callers always go through a prepared statement.
// $types is the mysqli bind string, e.g. "ss" for two strings.
function dbQuery(mysqli $conn, string $sql, string $types = '', array $params = []): mysqli_stmt
{
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        throw new RuntimeException('failed to prepare: ' . mysqli_error($conn));
    }
    if ($types !== '') {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    return $stmt;
}
