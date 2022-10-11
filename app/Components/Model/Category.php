<?php

namespace Solital\Components\Model;
use Solital\Components\Model\Model;

class Category extends Model
{
    public function __construct()
    {
        $this->table = "tb_category";
        $this->primaryKey = "idCategory";
        $this->columns = [
            "nameCategory"
        ];
    }

    /**
     * @return array
     */
    public function pagination()
    {
        return $this->instance()->pagination($this->table, 4);
    }

    /**
     * @return array
     */
    public function listAll()
    {
        return $this->instance()->select()->build('ALL');
    }
    
    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function list(int $id)
    {
        return $this->instance()->select($id)->build('ONLY');
    }

    /**
     * @param string $name
     * 
     * @return [type]
     */
    public function insert(string $name)
    {
        return $this->instance()->insert([$name]);
    }

    /**
     * @param string $name
     * @param int $id
     * 
     * @return [type]
     */
    public function update(string $name, int $id)
    {
        return $this->instance()->update($this->columns, [$name], "idCategory=$id");
    }

    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function delete(int $id)
    {
        return $this->instance()->delete($id)->build();
    }
}