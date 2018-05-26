<?php

namespace Model\Book;


use Model\AbstractModel;
use Service\FieldType\FieldType;

class Book extends AbstractModel
{
    const TABLE = 'books';

    protected static $_fields = [
        'id' => ['type' => FieldType::INT],
        'isbn' => ['type' => FieldType::INT],
        'author_full_name' => ['type' => FieldType::VARCHAR],
        'title' => ['type' => FieldType::VARCHAR],
        'year' => ['type' => FieldType::INT],
    ];
}