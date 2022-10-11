<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use CorreiosAPI\CorreiosAPI;
use Solital\Components\Model\Cep;
use Solital\Components\Model\Cart;
use Solital\Components\Model\CartFreight;
use Solital\Core\Resource\Message;
use Solital\Core\Resource\Session;
use Solital\Components\Model\Order;
use Solital\Components\Model\Product;

class CartController
{

    /**
     * @var int
     */
    private $total = 0;

    /**
     * @var int
     */
    private $freight = 0;

    /**
     * @var Session
     */
    private $cart = null;

    private $cartfreight = null;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->cart = (new Cart())->listCart();
        $this->cartfreight = (new CartFreight())->listCart();

    }

    /**
     * @return void
     */
    public function cart(): void
    {
        remove_param();

        /* if ($_SESSION['valorFrete']) {
            $this->freight = str_replace("R$ ", "", $_SESSION['valorFrete']);
        } */

        #pre($this->cartfreight);

        if (isset($this->cart)) {
            foreach ($this->cart as $cart2) {
                $this->total += $cart2->price * $cart2->qtd;
            }
        }

        Wolf::loadView('view.site.cart', [
            'title' => 'Carrinho',
            'cart' => $this->cart,
            'total' => $this->total,
            'freight' => $this->cartfreight,
            'msg1' => Message::get('cart.alert.success'),
            'msg2' => Message::get('cart.alert.error'),
        ]);

        Message::clear('cart.alert.success');
        Message::clear('cart.alert.error');
    }

    /**
     * @return void
     */
    public function addCart(): void
    {
        $idProduct = input()->post('idProduct')->getValue();
        $qtd = input()->post('qtd')->getValue();

        $prod = (new Product())->list($idProduct);

        if (Session::show('solital_index_profile')) {
            (new Cart())->insert((int)$idProduct, (int)Session::show('last_id'), (int)$qtd);
        } else {
            Session::new("cart", [
                'idsession' => session_id(),
                'idProduct' => $prod['idProduct'],
                'nameProduct' => $prod['nameProduct'],
                'price' => $prod['price'],
                'mainPhoto' => $prod['mainPhoto'],
                'qtd' => $qtd
            ], $idProduct);
        }

        Message::new('cart.alert.success', 'Produto adicionado ao carrinho!');
        redirect(url('cart'));
    }

    /**
     * @param int $idProduct
     * @param int $qtd
     * 
     * @return void
     */
    public function increase($idProduct, $qtd): void
    {
        if (Session::show('solital_index_profile')) {
            (new Cart())->changeQtd((int)++$qtd, $idProduct);
        } else {
            $_SESSION['cart'][$idProduct]->qtd = ++$qtd;
        }

        Message::new('cart.alert.success', 'Carrinho alterado');
        redirect(url('cart'));
    }

    /**
     * @param int $idProduct
     * @param int $qtd
     * 
     * @return void
     */
    public function decrease($idProduct, $qtd): void
    {
        if (Session::show('solital_index_profile')) {
            (new Cart())->changeQtd(--$qtd, $idProduct);
        } else {
            $_SESSION['cart'][$idProduct]->qtd = --$qtd;
        }

        Message::new('cart.alert.success', 'Carrinho alterado');
        redirect(url('cart'));
    }

    /**
     * @param string $idProduct
     * 
     * @return void
     */
    public function remove($idProduct): void
    {
        if (Session::show('solital_index_profile')) {
            (new Cart())->remove((int)$idProduct);
        } else {
            Session::delete('cart', $idProduct);
        }

        Message::new('cart.alert.success', 'Produto removido do carrinho');
        redirect(url('cart'));
    }

    /**
     * @return void
     */
    public function checkout(): void
    {
        if (!Session::has('solital_index_profile')) {
            Message::new('profile.login.error', 'É necessário realizar o login no site para finalizar a compra');
            redirect(url('profile.login'));
        }

        $idProfile = Session::show('last_id');

        foreach ($this->cart as $cart2) {
            $this->total += $cart2->price * $cart2->qtd;
        }

        Wolf::loadView('view.site.checkout', [
            'title' => 'Checkout',
            'address' => (new Cep())->listAddress((int)$idProfile),
            'cart' => $this->cart,
            'total' => $this->total
        ]);
    }

    /**
     * @return void
     */
    public function finishedPost(): void
    {
        if (!Session::has('solital_index_profile')) {
            Message::new('profile.login.error', 'É necessário realizar o login no site para finalizar a compra');
            redirect(url('profile.login'));
        }

        ob_start();
        echo date('Y-m-d H:i:s');
        $date = ob_get_contents();
        ob_end_clean();

        $all = input()->all();

        foreach ($this->cart as $cart2) {
            $this->total += $cart2->price * $cart2->qtd;
            $res = (new Order())->insert(
                $cart2->id,
                $cart2->idsession,
                $cart2->qtd,
                $all['cep'],
                $all['address'],
                $all['district'],
                $all['city'],
                $all['number'],
                $all['complement'],
                $all['payment'],
                $date
            );
        }

        if ($res == true) {
            session_regenerate_id(true);
            redirect(url('checkout.finished'));
        }
    }

    /**
     * @return void
     */
    public function finished(): void
    {
        if (!Session::has('solital_index_profile')) {
            Message::new('profile.login.error', 'É necessário realizar o login no site para finalizar a compra');
            redirect(url('profile.login'));
        }

        foreach ($this->cart as $cart2) {
            $this->total += $cart2->price * $cart2->qtd;
        }

        Wolf::loadView('view.site.finished', [
            'title' => 'Pedido finalizado',
            'cart' => $this->cart,
            'total' => $this->total
        ]);

        Session::delete('cart');
    }
}
