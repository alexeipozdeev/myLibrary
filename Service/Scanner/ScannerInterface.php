<?php

namespace Service\Scanner;


interface ScannerInterface
{
    /**
     * @param string $data
     * @return object
     * @throws ScannerException
     */
    public function dataReception(string $data);

    /**
     * @return string
     */
    public function getErrors(): string;
}