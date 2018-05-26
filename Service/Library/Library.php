<?php

namespace Service\Library;


use Model\AbstractModel;
use Service\DI\DI;

class Library
{
    /**
     * @param \stdClass $fields
     * @param AbstractModel $model
     * @return bool
     * @internal param array $fiels
     */
    public function add(\stdClass $fields, AbstractModel $model): bool
    {
        /* Наполняем объект данными и сохраняем в базу */
        $model->assign($fields)->save();
        DI::Log()->info('data recorded');

        return $model->isLoad();
    }
}