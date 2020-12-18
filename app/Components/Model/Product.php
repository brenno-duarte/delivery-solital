<?php

namespace Solital\Components\Model;

use Solital\Components\Model\Model;

class Product extends Model
{
    public function __construct()
    {
        $this->table = "tb_product";
        $this->primaryKey = "idProduct";
        $this->columns = [
            "idCategory",
            "nameProduct",
            "price",
            "description",
            "stock",
            "mainPhoto"
        ];
    }

    public function pagination()
    {
        return $this->instance()->pagination($this->table, 4, ['tb_category', "idCategory", "idCategory"]);
    }

    public function listAll()
    {
        return $this->instance()->innerJoin("tb_category", ["idCategory", "idCategory"])->build('ALL');
    }

    public function list($id)
    {
        return $this->instance()->innerJoin("tb_category", ["idCategory", "idCategory"], 'a.idProduct="'.$id.'"')->build('ONLY');
    }

    public function insert($idcategory, $nameproduct, $price, $description, $stock, $mainPhoto)
    {
        return $this->instance()->insert([$idcategory, $nameproduct, $price, $description, $stock, $mainPhoto], true);
    }

    public function update($idcategory, $nameproduct, $price, $description, $stock, $id)
    {
        return $this->instance()
            ->update($this->columns, [$idcategory, $nameproduct, $price, $description, $stock], "idProduct=$id");
    }

    public function delete($id)
    {
        return $this->instance()->delete($id, null, true)->build();
    }
}
