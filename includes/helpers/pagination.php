<?php

// Work out LIMIT/OFFSET and page numbers for a list of items.
function paginate(int $total, int $page, int $perPage = 12): array
{
    $pages = max(1, (int) ceil($total / $perPage));
    $page = max(1, min($page, $pages));
    return [
        'page'    => $page,
        'pages'   => $pages,
        'perPage' => $perPage,
        'offset'  => ($page - 1) * $perPage,
        'hasPrev' => $page > 1,
        'hasNext' => $page < $pages,
    ];
}
