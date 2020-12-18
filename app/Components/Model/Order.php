<?php

namespace Solital\Components\Model;
use Solital\Components\Model\Model;

class Order extends Model
{
    public function __construct()
    {
        $this->table = "tb_order";
        $this->primaryKey = "idOrder";
        $this->columns = [
            "idProduct",
            "idSession",
            "qtd",
            "address",
            "district",
            "city",
            "number",
            "complement",
            "payment",
            "order_status",
            "created_at"
        ];
    }

    public function pagination()
    {
        return $this->instance()->customPagination('SELECT created_at, order_status, idSession, SUM(idOrder) AS idOrder FROM `tb_order` WHERE order_status="Em Aberto" GROUP BY created_at, order_status, idSession', 4);
    }

    public function sendPagination()
    {
        return $this->instance()->customPagination('SELECT created_at, order_status, idSession, SUM(idOrder) AS idOrder FROM `tb_order` WHERE order_status="Enviado" GROUP BY created_at, order_status, idSession', 4);
    }

    public function receivedPagination()
    {
        return $this->instance()->customPagination('SELECT created_at, order_status, idSession, SUM(idOrder) AS idOrder FROM `tb_order` WHERE order_status="Entregue" GROUP BY created_at, order_status, idSession', 4);
    }

    public function returned()
    {
        return $this->instance()->select(null, 'order_status="Retornado"')->build('ALL');
    }

    public function listAll()
    {
        return $this->instance()->innerJoin("tb_category", ["idCategory", "idCategory"])->build('ALL');
    }

    public function list($id)
    {
        return $this->instance()->innerJoin("tb_product", ["idProduct", "idProduct"], 'idSession = "'.$id.'"')->build("ALL");

        // SELECT a.created_at, a.order_status, a.idSession, 
        // b.nameProduct, b.price, b.description, SUM(a.idOrder) AS idOrder FROM tb_order a 
        // INNER JOIN tb_product b WHERE a.idSession = "'.$id.'" GROUP BY a.created_at, a.order_status, 
        // a.idSession, b.nameProduct, b.price, b.description
    }

    public function insert($idproduct, $idsession, $qtd, $address , $district, $city, $number, $complement, $payment, $date)
    {
        return $this->instance()->insert([$idproduct, $idsession, $qtd, $address , $district, $city, $number, $complement, $payment, "Em Aberto", $date]);
    }

    public function update($status, $id)
    {
        return $this->instance()
            ->update(["order_status"], [$status], 'idSession="'.$id.'"');
    }

    public function delete($id)
    {
        $res = $this->instance()->delete($id, "idSession")->build();
        var_dump($res);
    }
}