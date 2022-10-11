<?php

namespace Solital\Components\Model;

use Solital\Components\Model\Model;

class Cep extends Model
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->table = "tb_address";
        $this->primaryKey = "idAddress";
        $this->columns = [
            "idProfile",
            "cep",
            "address",
            "district",
            "city",
            "state",
            "number",
            "complement"
        ];
    }

    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function listAddress(int $id)
    {
        return $this->instance()->select(null, "idProfile=$id")->build("ONLY");
    }

    /**
     * @param int $idProfile
     * @param string $address
     * @param string $district
     * @param string $city
     * @param string $state
     * @param int $number
     * @param string $complement
     * 
     * @return bool
     */
    public function insert(
        int $idProfile,
        string $cep,
        string $address,
        string $district,
        string $city,
        string $state,
        int $number,
        string $complement
    ) {
        return $this->instance()->insert([
            $idProfile, $cep, $address, $district, $city, $state, $number, $complement
        ]);
    }

    /**
     * @param int $idProfile
     * @param string $address
     * @param string $district
     * @param string $city
     * @param string $state
     * @param int $number
     * @param string $complement
     * 
     * @return bool
     */
    public function update(
        int $idProfile,
        string $cep,
        string $address,
        string $district,
        string $city,
        string $state,
        int $number,
        string $complement,
        int $id
    ) {
        return $this->instance()->update($this->columns, [
            $idProfile, $cep, $address, $district, $city, $state, $number, $complement
        ], $id);
    }
}
