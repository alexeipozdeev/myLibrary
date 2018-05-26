<?php

namespace Service\DI;

use Service\Db\Db;
use Service\Logger\LoggerInterface;
use Service\Request\Request;
use Service\Scanner\ScannerInterface;


/**
 * Class DI
 *
 * @method static Db                    Db
 * @method static Request               Request
 * @method static LoggerInterface       Log
 * @method static ScannerInterface      Scanner
 *
 */

class DI
{
    private static $service;

    /**
     * Наполнение контейнера сервисами
     */
    private static function init()
    {
        self::$service = [
            'Db' => [
                'object' => '',
                'class' => 'Service\\Db\\Db',
            ],
            'Request' => [
                'object' => '',
                'class' => 'Service\\Request\\Request',
            ],
            'Log' => [
                'object' => '',
                'class' => 'Service\\Logger\\LoggingFile',
            ],
            'Scanner' => [
                'object' => '',
                'class' => 'Service\\Scanner\\Scanner_LED',
            ],
        ];
    }

    /**
     * Получаем сервис из контейнера
     *
     * @param string $name
     * @return object
     * @throws DIException
     */
    private static function get(string $name)
    {
        self::init();

        if (!self::$service) {
            throw new DIException('Non install services');
        }

        if(!isset(self::$service[$name])) {
            throw new DIException('Service "'. $name . '" not install');
        }

        if (empty(self::$service[$name]['object'])) {
            $className = self::$service[$name]['class'];
            self::$service[$name]['object'] = new $className();
        }

        return self::$service[$name]['object'];
    }

    /**
     * Ловим вызов сервиса по имени.
     *
     * @param string $name
     * @param $arguments
     * @return object
     */
    public static function __callStatic(string $name, $arguments)
    {
        return self::get($name);
    }
}