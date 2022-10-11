<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use Solital\Core\Resource\Session;
use Solital\Components\Model\Photo;
use Solital\Components\Model\Product;
use Solital\Components\Model\Analytics;
use Solital\Components\Model\Cart;
use Solital\Components\Model\Category;

class StoreController
{
    /**
     * @var Session
     */
    private $cart;

    /**
     * Construct
     */
    public function __construct()
    {
        (new Analytics())->verify("product");
        $this->cart = (new Cart())->listCart();
    }

    /**
     * @return void
     */
    public function home(): void
    {
        remove_param();
        
        $pag = (new Product())->pagination();

        Wolf::loadView('view.site.home', [
            'title' => 'Delivery Master',
            'categories' => (new Category())->listAll(),
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

        $product = (new Product())->list($id);

        Wolf::loadView('view.site.product-detail', [
            'title' => $product['nameProduct'],
            'categories' => (new Category())->listAll(),
            'product' => $product,
            'photos' => (new Photo())->list($id),
            'cart' => $this->cart
        ]);
    }
}
