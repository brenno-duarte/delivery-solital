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

    public function list()
    {
        return $this->instance()->select()->build("ONLY");
    }

    public function listLogo($id)
    {
        return $this->instance()->select($id, null, "logo")->build("ONLY");
    }

    public function update($companyName, $phone, $email, $address, $district, $state, $number, $photo, $id)
    {
        return $this->instance()->update($this->columns, [$companyName, $phone, $email, $address, $district, $state, (int)$number, $photo], (int)$id);
    }

    public function updatePhoto($photo, $id)
    {
        return $this->instance()->update(["logo"], [$photo], (int)$id);
    }
}