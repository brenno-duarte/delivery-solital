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
            "mainPhoto",
            "weight",
            "width",
            "length",
            "height"
        ];
    }

    /**
     * @return null|array
     */
    public function pagination()
    {
        return $this->instance()
                    ->pagination($this->table, 4, ['tb_category', "idCategory", "idCategory"]);
    }

    /**
     * @return null|array
     */
    public function listAll()
    {
        return $this->instance()
                    ->innerJoin("tb_category", ["idCategory", "idCategory"])->build('ALL');
    }

    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function list(int $id)
    {
        return $this->instance()
                    ->innerJoin("tb_category", ["idCategory", "idCategory"], 'a.idProduct="' . $id . '"')->build('ONLY');
    }

    /**
     * @param int $idcategory
     * @param string $nameproduct
     * @param mixed $price
     * @param string $description
     * @param int $stock
     * @param mixed $mainPhoto
     * @param float $weight
     * @param float $width
     * @param float $length
     * @param float $height
     * 
     * @return bool
     */
    public function insert(
        int $idcategory,
        string $nameproduct,
        $price,
        string $description,
        int $stock,
        $mainPhoto,
        float $weight,
        float $width,
        float $length,
        float $height
    ) {
        return $this->instance()->insert([
            $idcategory, $nameproduct, $price, $description, $stock, $mainPhoto, $weight, $width, $length, $height
        ], true);
    }

    /**
     * @param int $idcategory
     * @param string $nameproduct
     * @param mixed $price
     * @param string $description
     * @param mixed $stock
     * @param mixed $mainPhoto
     * @param float $weight
     * @param float $width
     * @param float $length
     * @param float $height
     * @param int $id
     * 
     * @return bool
     */
    public function update(
        int $idcategory,
        string $nameproduct,
        $price,
        string $description,
        $stock,
        $mainPhoto,
        float $weight,
        float $width,
        float $length,
        float $height,
        int $id
    ) {
        return $this->instance()
            ->update($this->columns, [
                $idcategory, $nameproduct, $price, $description, $stock, $mainPhoto, $weight, $width, $length, $height
            ], "idProduct=$id");
    }

    /**
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->instance()->delete($id, null, true)->build();
    }
}
