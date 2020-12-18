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

    public function pagination()
    {
        return $this->instance()->pagination($this->table, 4);
    }

    public function listAll()
    {
        return $this->instance()->select()->build('ALL');
    }
    
    public function list($id)
    {
        return $this->instance()->select($id)->build('ONLY');
    }

    public function insert($name)
    {
        return $this->instance()->insert([$name]);
    }

    public function update($name, $id)
    {
        return $this->instance()->update($this->columns, [$name], "idCategory=$id");
    }

    public function delete($id)
    {
        return $this->instance()->delete($id)->build();
    }
}