<?php

namespace Model;


use Service\DI\DI;
use Service\FieldType\FieldType;

class AbstractModel implements ModelInterface
{
    private static $_fields = [];
    const TABLE = null;
    private $isLoad = false;

    public function __construct()
    {
        if (static::TABLE === null) {
            throw new ModelException('No table is specified for the model');
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->cast($name, $this->_protoObject->{$name});
    }


    /**
     * @param string $name
     * @param mixed $value
     * @throws ModelException
     */
    public function __set(string $name, $value): void
    {
        if (!isset(static::$_fields[$name])) {
            throw new ModelException('Attempt to assign a value to a non-public property "' . $name . '"');
        }

        $this->{$name} = $this->cast($name, $value);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset(static::$_fields[$name]);
    }

    /**
     * @param mixed $data
     * @return AbstractModel
     */
    public function assign($data): AbstractModel
    {
        foreach ($data as $k => $v) {
            if (isset(static::$_fields[$k])) {
                $this->{$k} = $this->cast($k, $v);
            }
        }

        return $this;
    }

    /**
     * Преобразует значение к указанному типу поля модели.
     *
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    private function cast(string $name, $value)
    {
        $field = static::$_fields[$name];
        if (is_array($field)) {
            switch ($field['type']) {
                case FieldType::BOOL:
                    return (bool) $value;
                case FieldType::INT:
                    return (int) $value;
                case FieldType::VARCHAR:
                    return (string) $value;
                case FieldType::TEXT:
                    return (string) $value;
                case FieldType::FLOAT:
                    return (float) $value;
                default:
                    return $value;
            }
        } else {
            return $value;
        }
    }

    /**
     * @return bool
     */
    public function isLoad(): bool
    {
        return $this->isLoad;
    }

    /**
     * @param bool $value
     */
    public function setIsLoad(bool $value): void
    {
        $this->isLoad = (bool) $value;
    }

    /**
     * @return array
     */
    public static function getFields(): array
    {
        return array_keys(static::$_fields);
    }

    /**
     * @return AbstractModel
     */
    private function insert(): AbstractModel
    {
        $data = [];
        foreach ($this as $field => $value) {
            if(!isset(static::$_fields[$field])) {
                continue;
            }
            $data[$field] = $value;
        }

        $fields = array_keys($data);
        $sqlFields = implode(", ", $fields);
        $sqlValues = implode(', ', preg_filter('/^/', ':', $fields));

        $sql = "INSERT INTO " . static::TABLE . " (" . $sqlFields . ") VALUES (" . $sqlValues . ")";
        $this->id = DI::Db()->prepare($sql, $data)->run()->lastInsertId();

        return $this;
    }

    /**
     * @return AbstractModel
     */
    private function update(): AbstractModel
    {
        $data = [];
        foreach ($this as $field => $value) {
            if(!isset(static::$_fields[$field])) {
                continue;
            }
            $data[$field] = $value;
        }

        $fieldSet = [];
        foreach ($data as $field => $value) {
            $fieldSet[] = "$field = :$field";
        }
        $setFields = implode(', ', $fieldSet);
        $data['id'] = $this->id;

        $sql = "UPDATE " . static::TABLE . " SET " . $setFields . " WHERE id = :id";
        $this->countUpdate = DI::Db()->prepare($sql, $data)->run();

        return $this;
    }

    /**
     * @return AbstractModel
     * @throws ModelException
     */
    public function save(): AbstractModel
    {
        if($this->isLoad() ? $this->update() : $this->insert()) {
            $this->setIsLoad(true);

            return $this;
        } else {
            throw new ModelException('Failed to save the object');
        }
    }

    /**
     * @param array $conditions
     * @return AbstractModel
     * @throws ModelException
     */
    public function load(array $conditions): AbstractModel
    {
        if(!$conditions) {
            throw new ModelException('No conditions specified');
        }

        $sqlFields = implode(', ', self::getFields());
        $sqlConditions = [];

        if($conditions) {
            $whereFields = [];
            foreach ($conditions as $field => $value) {
                $whereFields[] = $field . ' = :' . $field;
            }
            $sqlConditions = ' WHERE ' . $sqlValues = implode(' AND ', $whereFields);
        }

        $sql = 'SELECT ' . $sqlFields . ' FROM ' . static::TABLE . $sqlConditions;
        $row = DI::Db()->prepare($sql, $conditions)->run()->one();

        if(!$row) {
            return null;
        }

        $this->assign($row);
        $this->setIsLoad(true);
        $this->id = $row->id;

        return $this;
    }

    /**
     * @param array $fields
     * @param array $conditions
     * @param array $orderBy
     * @return array
     */
    public static function getCollections(array $fields, array $conditions = [], array $orderBy = []): array
    {
        $fields = $fields ? $fields : self::getFields();
        $sqlFields = implode(', ', $fields);
        $sqlConditions = $sqlOrderBy = $sortDirection = '';

        if($conditions) {
            $whereFields = [];
            foreach ($conditions as $field => $value) {
                $whereFields[] = $field . ' = :' . $field;
            }
            $sqlConditions = ' WHERE ' . $sqlValues = implode(' AND ', $whereFields);
        }

        if($orderBy) {
            $key = array_search('DESC', $orderBy);
            if ($key) {
                $sortDirection = ' DESC';
                unset($orderBy[$key]);
            }
            $sqlOrderBy = ' ORDER BY ' . implode(', ', $orderBy) . $sortDirection;
        }

        $sql = 'SELECT ' . $sqlFields . ' FROM ' . static::TABLE . $sqlConditions . $sqlOrderBy;
        $items = DI::Db()->prepare($sql, $conditions)->run()->all();

        return $items;
    }

    public function delete()
    {
        if(!$this->isLoad) {
            throw new ModelException('No load object');
        }

        $sql = 'DELETE FROM ' . static::TABLE . " WHERE id = :id";
        return DI::Db()->prepare($sql, ['id' => $this->id])->run();
    }
}