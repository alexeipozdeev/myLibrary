<?php

use Service\DI\DI;

header("Content-type: text/html; charset=utf-8");
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

$sql = "SELECT
          author_full_name,
          count(*) AS number_books
        FROM books GROUP BY author_full_name ORDER BY number_books DESC LIMIT 100";

$rows = DI::Db()->prepare($sql, [])->run()->all();

echo json_encode($rows);