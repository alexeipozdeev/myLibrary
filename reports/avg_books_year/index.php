<?php

use Service\DI\DI;

header("Content-type: text/html; charset=utf-8");
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

$sql = "SELECT
  b.author_full_name,
  b.year, 
  AVG(b.number_books) AS avg_number
FROM (
  SELECT
    author_full_name,
    year,
    count(*) AS number_books
  FROM books
  GROUP BY year
) b
GROUP BY b.author_full_name";

$rows = DI::Db()->prepare($sql, [])->run()->all();

echo json_encode($rows);