<?php

use Service\DI\DI;

header("Content-type: text/html; charset=utf-8");
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

$dateTo = DI::Request()->get('dateTo');
$dateFrom = DI::Request()->get('dateFrom');
if(!$dateTo || !$dateFrom) {
    echo json_encode(['error' => 'Do not specify a date range']);
}

$sql = "SELECT
          isbn,
          author_full_name,
          title,
          year
        FROM books WHERE year BETWEEN :dateFrom AND :dateTo";

$rows = DI::Db()->prepare($sql, ['dateFrom' => $dateFrom, 'dateTo' => $dateTo])->run()->all();

echo json_encode($rows);