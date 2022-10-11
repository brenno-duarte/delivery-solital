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

    /**
     * @return null|array
     */
    public function listAll()
    {
        return $this->instance()->select()->build('All');
    }
    
    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function list(int $id)
    {
        return $this->instance()->select(null, "idProduct = $id")->build('ALL');
    }

    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function listPhoto(int $id)
    {
        return $this->instance()->select($id)->build('ONLY');
    }

    /**
     * @param int $idproduct
     * @param string $namephoto
     * 
     * @return bool
     */
    public function insert(int $idproduct, string $namephoto)
    {
        return $this->instance()->insert([$idproduct, $namephoto]);
    }

    /**
     * @param int $idphoto
     * @param string $namephoto
     * 
     * @return bool
     */
    public function update(int $idphoto, string $namephoto)
    {
        return $this->instance()->update(["namePhoto"], [$namephoto], $idphoto);
    }

    /**
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->instance()->delete($id)->build();
    }
}