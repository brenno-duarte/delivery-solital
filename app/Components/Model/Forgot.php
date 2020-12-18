<?php

namespace Solital\Components\Model;
use Solital\Components\Model\Model;

class Forgot extends Model
{
    public function __construct()
    {
        $this->table = "tb_auth";
        $this->primaryKey = "id_user";
        $this->columns = [
            "username",
            "pass"
        ];
    }

    public function update($pass, $email)
    {
        return $this->instance()->update(["pass"], [$pass], 'username="'.$email.'"');
    }
}