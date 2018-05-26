<?php

namespace Service\Db;


use mysqli;
use Service\DI\DI;
use PDO;
use PDOException;
use PDOStatement;

class Db
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * @var PDOStatement
     */
    private $stmt;

    /**
     * Db constructor.
     * @throws DbException
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:dbname=library;host=localhost',
                'root',
                'gfhfvgfvgfv',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            throw new DbException('Could not connect to database: ' . $e->getMessage());
        }
    }

    /**
     * Биндим переменные в запрос
     *
     * @param string $sql
     * @param array $fields
     * @return Db
     * @throws DbException
     */
    public function prepare(string $sql, array $fields = []): Db
    {
        if($sql === '') {
            throw new DbException('No query is specified');
        }

        $this->stmt = $this->connection->prepare($sql);

        foreach ($fields as $field => $value) {
            $this->stmt->bindValue(':' . $field, $value);
        }

        return $this;
    }

    /**
     * Выполняем запрос
     *
     * @return Db
     * @throws DbException
     */
    public function run(): Db
    {
        if (!$this->stmt) {
            throw new DbException('There is no query to run');
        }
        $this->stmt->execute();

        return $this;
    }

    /**
     * Возвращаем результат в виде объекта
     *
     * @return mixed
     * @throws DbException
     */
    public function one(): mixed
    {
        if (!$this->stmt) {
            throw new DbException('There is no data to output');
        }

        return $this->stmt->fetchObject();
    }


    /**
     * Возвращаем результат в виде ассоциативного массива
     *
     * @return array
     * @throws DbException
     */
    public function all(): array
    {
        if (!$this->stmt) {
            throw new DbException('There is no data to output');
        }

        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Возвращаем иднтификатор вставленной строки в таблицу
     *
     * @return int
     * @throws DbException
     */
    public function lastInsertId(): int
    {
        if (!$this) {
            throw new DbException('There is no data to output');
        }

        return (int) $this->connection->lastInsertId();
    }
}