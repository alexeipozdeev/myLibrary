<?php

use Service\DI\DI;

header("Content-type: text/html; charset=utf-8");
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

$author_name = DI::Request()->get('author_name');
if(!$author_name) {
    echo json_encode(['error' => 'No author specified']);
}

$sql = "SELECT
          isbn,
          title,
          year
        FROM books WHERE author_full_name LIKE '%:author_name%'";

$rows = DI::Db()->prepare($sql, ['author_full_name' => $author_name])->run()->all();

echo json_encode($rows);