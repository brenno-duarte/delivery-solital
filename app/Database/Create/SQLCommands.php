<?php

namespace Solital\Database\Create;
use Solital\Components\Model\Model;

class SQLCommands extends Model
{
    public function cart()
    {
        $this->instance()->createTable('tb_cartfreight')
                        ->int('idFreight')->primary()->increment()
                        ->int('idCart')->notNull()
                        ->int('idProfile')->notNull()
                        ->varchar('freightValue', 20)->notNull()
                        ->varchar('days', 20)->notNull()
                        ->varchar('totalFreight', 50)->notNull()
                        ->constraint("cartfreight_cart_fk")->foreign("idCart")->references("tb_cart", "idCart")
                        ->constraint("cartfreight_profile_fk")->foreign("idProfile")->references("tb_profile", "idProfile")
                        ->timestamp('created_at')->default('current_timestamp')
                        ->closeTable()
                        ->build();

        
    }

    public function tables()
    {
        #$res = $this->instance()->listTables()->build('all');
        $res = $this->instance()->describeTable('tb_product')->build('all');
        pre($res);
    }

    public function truncate()
    {
        #$res = $this->instance()->listTables()->build('all');
        $res = $this->instance()->truncate('tb_product', true)->build();
        #pre($res);
    }

    public function addPro()
    {
        $this->instance()
            ->alter("tb_cart")
            ->addConstraint("cart_profile_fk")->foreign("idProfile")->references("tb_profile", "idProfile")
            ->build();
    }
}
