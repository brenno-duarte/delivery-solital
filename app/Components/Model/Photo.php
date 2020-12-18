<?php

namespace Solital\Components\Model;
use Solital\Components\Model\Model;

class Photo extends Model
{
    public function __construct()
    {
        $this->table = "tb_photos";
        $this->primaryKey = "idPhoto";
        $this->columns = [
            "idProduct",
            "namePhoto"
        ];
    }

    public function listAll()
    {
        return $this->instance()->select()->build('All');
    }
    
    public function list($id)
    {
        return $this->instance()
                    ->customQueryAll("SELECT * FROM $this->table WHERE idProduct = $id");
    }

    public function insert($idproduct, $namephoto)
    {
        return $this->instance()->insert([$idproduct, $namephoto]);
    }

    public function delete($id)
    {
        return $this->instance()->delete($id, "idProduct")->build();
    }
}