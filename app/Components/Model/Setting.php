<?php

namespace Solital\Components\Model;

use Solital\Components\Model\Model;

class Setting extends Model
{
    public function __construct()
    {
        $this->table = "tb_settings";
        $this->primaryKey = "idSet";
        $this->columns = [
            "companyName",
            "phone",
            "email",
            "address",
            "district",
            "state",
            "number",
            "logo"
        ];
    }

    /**
     * @return null|array
     */
    public function list()
    {
        return $this->instance()->select()->build("ONLY");
    }

    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function listLogo(int $id)
    {
        return $this->instance()->select($id, null, "logo")->build("ONLY");
    }

    /**
     * @param string $companyName
     * @param string $phone
     * @param string $email
     * @param string $address
     * @param string $district
     * @param string $state
     * @param int $number
     * @param mixed $photo
     * @param int $id
     * 
     * @return bool
     */
    public function update(
        string $companyName,
        string $phone,
        string $email,
        string $address,
        string $district,
        string $state,
        int $number,
        $photo,
        int $id
    ) {
        return $this->instance()->update(
            $this->columns,
            [$companyName, $phone, $email, $address, $district, $state, (int)$number, $photo],
            (int)$id
        );
    }

    /**
     * @param mixed $photo
     * @param int $id
     * 
     * @return bool
     */
    public function updatePhoto($photo, int $id)
    {
        return $this->instance()->update(["logo"], [$photo], (int)$id);
    }
}
