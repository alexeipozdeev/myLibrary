<?php

namespace Service\Logger;

interface LoggerInterface
{
    /**
     * @param string $error
     */
    public function error(string $error): void;

    /**
     * @param string $info
     */
    public function info(string $info): void;
}