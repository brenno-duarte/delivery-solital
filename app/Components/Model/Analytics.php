<?php

namespace Solital\Components\Model;

use Solital\Components\Model\Model;
use Solital\Core\Resource\Cookie;

class Analytics extends Model
{
    public function __construct()
    {
        $this->table = "tb_analytics";
        $this->primaryKey = "idAnalytic";
        $this->columns = [
            "views",
            "url",
            "created_at"
        ];
    }

    /**
     * @param string $uri
     * 
     * @return void
     */
    public function verify(string $uri): void
    {
        $date = $this->instance()->select(null, "DATE(created_at) = DATE(now())")->build("ALL");

        if ($date != date('Y-m-d H:i:s')) {
            if (Cookie::has('last_id') == false) {
                if (strpos($_SERVER['REQUEST_URI'], $uri) !== false) {
                    $id = $this->instance()->insert(['1', $_SERVER['REQUEST_URI'], 'NOW()'], true);
                    Cookie::delete('last_id', $id['lastId']);
                    Cookie::new('last_id', $id['lastId']);
                }
            }

            if (Cookie::has('last_id') == true) {
                if (strpos($_SERVER['REQUEST_URI'], $uri) !== false) {
                    $this->instance()->update(['views'], ['views +1'], "idAnalytic=" . Cookie::show('last_id'));
                }
            }
        }
    }

    /**
     * @return null|array
     */
    public function list()
    {
        return $this->instance()->select(null, "DATE(created_at) = DATE(now())")->build("ALL");
    }
}
