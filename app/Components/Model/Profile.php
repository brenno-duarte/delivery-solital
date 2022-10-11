<?php

namespace Solital\Components\Model;

use Solital\Components\Model\Model;
use Solital\Core\Resource\Session;

class Profile extends Model
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->table = "tb_profile";
        $this->primaryKey = "idProfile";
        $this->columns = [
            "name",
            "email",
            "phone",
            "password"
        ];
    }

    /**
     * @return Profile
     */
    public function verifyLogin(): Profile
    {
        if (empty(Session::show('solital_index_profile'))) {
            response()->redirect(url('profile.login'));
        }

        return $this;
    }

    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function list(int $id)
    {
        return $this->instance()->select($id)->build("ONLY");
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $password
     * 
     * @return bool
     */
    public function insert(string $name, string $email, string $phone, string $password)
    {
        return $this->instance()->insert([$name, $email, $phone, $password], true);
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param int $id
     * 
     * @return bool
     */
    public function update(string $name, string $email, string $phone, int $id)
    {
        return $this->instance()->update(['name', 'email', 'phone'], [$name, $email, $phone], $id);
    }

    /**
     * @param string $password
     * @param int $id
     * 
     * @return bool
     */
    public function updatePass(string $password, int $id)
    {
        return $this->instance()->update(['password'], [$password], $id);
    }
}
