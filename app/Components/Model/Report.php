<?php

namespace Solital\Components\Model;
use Solital\Components\Model\Model;

class Report extends Model
{
    public function __construct()
    {
        $this->table = "";
        $this->primaryKey = "";
        $this->columns = [];
    }

    public function billingMonth($date = "NOW()")
    {
        return $this->instance()->customQueryAll("SELECT a.idSession, SUM(b.price) AS price, SUM(a.qtd) 
        AS qtd FROM tb_order a INNER JOIN tb_product b WHERE MONTH( a.created_at) = MONTH($date) 
        GROUP BY a.idSession");
    }

    public function billingTotal()
    {
        return $this->instance()->customQueryAll("SELECT a.idSession, SUM(b.price) AS price, 
        SUM(a.qtd) AS qtd FROM tb_order a INNER JOIN tb_product b GROUP BY a.idSession");
    }

    public function billingCustom()
    {
        
    }
}