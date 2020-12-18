<?php

namespace Solital\Database\Create;
use Solital\Components\Model\Model;
use Solital\Database\Create\Create;

class SQLCommands extends Model
{
    public function analytic()
    {
        $res = $this->instance()->createTable('tb_analytics')
                                ->int('idAnalytic')->primary()->increment()
                                ->int('views')->notNull()
                                ->varchar('url', 255)->notNull()
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
}
