<?php

namespace Solital\Components\Model;

use Solital\Core\Resource\Session;
use Solital\Components\Model\Model;

class CartFreight extends Model
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->table = "tb_cartfreight";
        $this->primaryKey = "idFreight";
        $this->columns = [
            "idProfile",
            "freightValue",
            "days",
            "totalFreight"
        ];
    }

    /**
     * @return null|array
     */
    public function listCart()
    {
        if (Session::show('cart')) {
            $cartfreight = Session::show('cartfreight');
        } elseif (Session::show('last_id')) {
            $cartfreight = $this->listAll((int)Session::show('last_id'));
        } else {
            $cartfreight = null;
        }

        return $cartfreight;
    }

    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function listAll(int $id)
    {
        $res = $this->instance()->customQueryOnly("SELECT * FROM tb_cartfreight a 
        INNER JOIN tb_profile b 
        ON a.idProfile=b.idProfile 
        WHERE a.idProfile=$id");

        $obj = json_decode(json_encode($res));

        return $obj;
    }

    /**
     * @param int $idProfile
     * @param mixed $freightValue
     * @param int $days
     * @param mixed $totalFreight
     * 
     * @return bool
     */
    public function insert(int $idProfile, $freightValue, int $days, $totalFreight)
    {
        return $this->instance()->insert([$idProfile, $freightValue, $days, $totalFreight]);
    }

    /**
     * @param int $idProfile
     * @param mixed $freightValue
     * @param int $days
     * @param mixed $totalFreight
     * 
     * @return bool
     */
    public function update(int $idProfile, $freightValue, int $days, $totalFreight)
    {
        return $this->instance()->update(
            ['freightValue', 'days', 'totalFreight'],
            [$freightValue, $days, $totalFreight],
            "idProfile=$idProfile"
        );
    }
}
