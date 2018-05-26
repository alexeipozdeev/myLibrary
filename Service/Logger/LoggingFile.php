<?php

namespace Service\Logger;


class LoggingFile implements LoggerInterface
{
    /**
     * Пишем ошибку в лог ошибок
     *
     * @param string $error
     */
    public function error(string $error): void
    {
        $file = dirname(__FILE__) . '/../error_log_scanner.txt';
        $log = fopen($file, 'a');
        fwrite($log, $error . PHP_EOL);
        fclose($log);
    }

    /**
     * Пишем сообщение в лог информации
     *
     * @param string $info
     */
    public function info(string $info): void
    {
        $file = dirname(__FILE__) . '/../log_scanner.txt';
        $log = fopen($file, 'a');
        fwrite($log, $info . PHP_EOL);
        fclose($log);
    }
}