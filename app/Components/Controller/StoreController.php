<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use Solital\Core\Resource\Session;
use Solital\Components\Model\Photo;
use Solital\Components\Model\Product;
use Solital\Components\Model\Analytics;

class StoreController
{
    private $cart;

    public function __construct()
    {
        (new Analytics())->verify("product");
        $this->cart = Session::show('cart');
    }

    /**
     * @return void
     */
    public function home(): void
    {
        $pag = (new Product())->pagination();

        Wolf::loadView('view.site.home', [
            'title' => 'Delivery Master',
            'products' => $pag['rows'],
            'arrows' => $pag['arrows'],
            'cart' => $this->cart
        ]);
    }

    /**
     * @param string $id
     * @param string $name
     * @return void
     */
    public function detailProduct($id, $name): void
    {
        remove_param();
        Wolf::loadView('view.site.product-detail', [
            'title' => ucwords(str_replace("_", " ", $name)),
            'product' => (new Product())->list($id),
            'photos' => (new Photo())->list($id),
            'first_photo' => (new Photo())->list($id)[0],
            'cart' => $this->cart
        ]);
    }
}