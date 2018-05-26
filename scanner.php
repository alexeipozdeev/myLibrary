<?php

use Model\Book\Book;
use Model\Disk\Disk;
use Service\DI\DI;
use Service\Library\Library;
use Service\Scanner\ScannerException;

header("Content-type: text/html; charset=utf-8");

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

/* Функцтя возврата сосотояния сканеру */
function stateReturn (bool $success, string $message) {
    /* Пишем в лог либо ошибку либо успешно добавленную запись */
    $success ? DI::Log()->info($message) : DI::Log()->error($message);

    /* выводим сообщение сканеру */
    exit(
        json_encode([
            'success' => $success,
            'message' => $message
        ])
    );
}

/* получаем от сканера данные */
$data = DI::Request()->get('dataScaner');

/* если данных нет, то говорим об этом сканеру*/
if(!$data) {
    stateReturn(false, 'No input data');
}

/* пытаемся распознать данные и записать их в базу */
try {
    /* если данные не удалось распарсить*/
    if(!$fields = DI::Scanner()->dataReception($data)) {
        stateReturn(false, DI::Scanner()->getErrors());
    }

    $model = isset($fields->isbn) ? new Book() : new Disk();
    $library = new Library();
    $library->add($fields, $model);

    /* сообщаем сканеру об успешной операции */
    stateReturn(true, 'Added successfully "' . $model->title . '" ID: ' . $model->id);
} catch (Exception $e) {
    /* если что-то пошло не так */
    stateReturn(false, $e->getMessage());
    throw new ScannerException("Unable to write data");
}