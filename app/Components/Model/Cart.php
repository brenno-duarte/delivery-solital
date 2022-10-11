<?php

namespace Solital\Components\Model;

use Solital\Core\Resource\Session;
use Solital\Components\Model\Model;

class Cart extends Model
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->table = "tb_cart";
        $this->primaryKey = "idCart";
        $this->columns = [
            "idProduct",
            "idProfile",
            "qtd"
        ];
    }

    /**
     * @return Cart
     */
    public function listCart()
    {
        if (Session::show('cart')) {
            $cart = Session::show('cart');
        } elseif (Session::show('last_id')) {
            $cart = $this->listAll((int)Session::show('last_id'));
        } else {
            $cart = null;
        }

        return $cart;
    }

    /**
     * @param int $id
     * 
     * @return null|array
     */
    public function listAll(int $id)
    {
        $res = $this->instance()->customQueryAll("SELECT * FROM tb_cart a 
        INNER JOIN tb_profile b 
        INNER JOIN tb_product c 
        ON a.idProfile=b.idProfile 
        AND a.idProduct=c.idProduct WHERE a.idProfile=$id");

        $obj = json_decode(json_encode($res));

        return $obj;
    }

    /**
     * @param int $idProfile
     * 
     * @return null|array
     */
    public function listSum(int $idProfile)
    {
        return $this->instance()->customQueryOnly(
            "SELECT SUM(a.price*b.qtd) AS totalPrice, 
            SUM(a.weight*b.qtd) AS totalWeight, 
            SUM(a.width*b.qtd) AS totalWidth, 
            SUM(a.length*b.qtd) AS totalLength, 
            SUM(a.height*b.qtd) AS totalHeight, 
            SUM(b.qtd) AS totalQtd FROM tb_product a 
            INNER JOIN tb_cart b 
            ON a.idProduct=b.idProduct 
            WHERE b.idProfile=14"
        );
    }

    /**
     * @param int $id
     * 
     * @return mixed
     */
    public function insert(int $idProduct, int $idProfile, int $qtd)
    {
        return $this->instance()->insert([$idProduct, $idProfile, $qtd]);
    }

    /**
     * @param int $qtd
     * @param int $idProduct
     * 
     * @return bool
     */
    public function changeQtd(int $qtd, int $idProduct)
    {
        return $this->instance()->update(['qtd'], [$qtd], "idProduct=$idProduct", true);
    }

    /**
     * @param int $idProduct
     * 
     * @return bool
     */
    public function remove(int $idProduct)
    {
        return $this->instance()->delete($idProduct, "idProduct")->build();
    }
}
