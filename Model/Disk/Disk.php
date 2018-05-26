<?php

namespace Model\Disk;


use Model\AbstractModel;
use Service\FieldType\FieldType;

class Disk extends AbstractModel
{
    const TABLE = 'disks';

    protected static $_fields = [
        'id' => ['type' => FieldType::INT],
        'singer' => ['type' => FieldType::VARCHAR],
        'title' => ['type' => FieldType::VARCHAR],
        'year' => ['type' => FieldType::INT],
    ];
}