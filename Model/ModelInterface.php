<?php

namespace Model;

interface ModelInterface
{
    /**
     * @param array $data
     * @return AbstractModel
     */
    public function assign($data): AbstractModel;

    /**
     * @return bool
     */
    public function isLoad(): bool;

    /**
     * @param bool $value
     */
    public function setIsLoad(bool $value): void;

    /**
     * @return AbstractModel
     * @throws ModelException
     */
    public function save(): AbstractModel;

    /**
     * @param array $conditions
     * @return AbstractModel
     * @throws ModelException
     */
    public function load(array $conditions): AbstractModel;

    public function delete();
}