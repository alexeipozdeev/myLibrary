<?php

namespace Service\Request;


class Request
{
    /**
     * Проверяем просто наличие переменной
     *
     * @param string $name
     * @return bool
     */
    public function inGet(string $name): bool
    {
        return isset($_GET[$name]) || isset($_POST[$name]) ? true : false;
    }

    /**
     * Получаем значение переменной
     *
     * @param string $name
     * @return mixed
     * @throws RequestException
     */
    public function get(string $name): mixed
    {
        if(empty($name)) {
            throw new RequestException('Request variable name not specified');
        }

        if (isset($_GET[$name])) {
            return $_GET[$name];
        } elseif (isset($_POST[$name])) {
            return $_POST[$name];
        } else {
            return null;
        }
    }
}