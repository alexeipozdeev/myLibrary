<?php

namespace Service\FieldType;


class FieldType
{
    /** Тип поля модели boolean */
    const BOOL = 0;
    /** Тип поля модели integer */
    const INT = 1;
    /** Тип поля модели string */
    const VARCHAR = 2;
    /** Тип поля модели для сериализованных данных */
    const TEXT = 3;
    /** Тип поля модели для даты */
    const DATETIME = 4;
    /** Тип поля модели float */
    const FLOAT = 5;

    //название типов, которые указываются в fields в модели
    const FIELDS = [
        self::BOOL => 'bool',
        self::INT => 'int',
        self::VARCHAR => 'varchar',
        self::TEXT => 'text',
        self::DATETIME => 'datetime',
        self::FLOAT => 'float',
    ];
}