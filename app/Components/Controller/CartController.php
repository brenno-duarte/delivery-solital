<?php

namespace Solital\Components\Controller;

use Solital\Components\Model\Order;
use Solital\Components\Model\Product;
use Solital\Core\Resource\Message;
use Solital\Core\Resource\Session;
use Solital\Core\Wolf\Wolf;

class CartController
{
    /**
     * @return void
     */
    public function cart(): void 
    {
        remove_param();
        $cart = Session::show('cart');
        $total = 0;
        if (isset($cart)) {
            foreach ($cart as $cart2) {
                $total += $cart2->price*$cart2->qtd;
            }
        }

        Wolf::loadView('view.site.cart', [
            'title' => 'Carrinho',
            'cart' => $cart,
            'total' => $total,
            'msg1' => Message::get('increase'),
            'msg2' => Message::get('decrease'),
            'msg3' => Message::get('remove')
        ]);

        Message::clear('increase');
        Message::clear('decrease');
        Message::clear('remove');
    }

    /**
     * @return void
     */
    public function addCart(): void
    {
        $idProduct = input()->post('idProduct')->getValue();
        $qtd = input()->post('qtd')->getValue();
        
        $prod = (new Product())->list($idProduct);
        
        Session::new("cart", [
            'idsession' => session_id(),
            'id' => $prod['idProduct'],
            'name' => $prod['nameProduct'],
            'price' => $prod['price'],
            'photo' => $prod['mainPhoto'],
            'qtd' => $qtd
        ], $idProduct);
 
        redirect(url('cart'));
    }

    /**
     * @param string $id
     * @param string $qtd
     * @return void
     */
    public function increase($id, $qtd): void
    {
        $_SESSION['cart'][$id]->qtd = ++$qtd;
        Message::new('increase', 'Carrinho alterado');
        redirect(url('cart'));
    }

    /**
     * @param string $id
     * @param string $qtd
     * @return void
     */
    public function decrease($id, $qtd): void
    {
        $_SESSION['cart'][$id]->qtd = --$qtd;
        Message::new('decrease', 'Carrinho alterado');
        redirect(url('cart'));
    }

    /**
     * @param string $id
     * @return void
     */
    public function remove($id): void 
    {
        Session::delete('cart', $id);
        Message::new('remove', 'Produto removido do carrinho');
        redirect(url('cart'));
    }
    
    /**
     * @return void
     */
    public function checkout(): void
    {
        if (Session::has('cart') == false) {
            redirect(url('home'));
        }

        $cart = Session::show('cart');
        $total = 0;
        foreach ($cart as $cart2) {
            $total += $cart2->price*$cart2->qtd;
        }

        Wolf::loadView('view.site.checkout', [
            'title' => 'Checkout',
            'cart' => $cart,
            'total' => $total
        ]);
    }

    /**
     * @return void
     */
    public function finishedPost(): void
    {
        if (Session::has('cart') == false) {
            redirect(url('home'));
        }

        ob_start();
        echo date('Y-m-d H:i:s');
        $date = ob_get_contents();
        ob_end_clean();

        $cart = Session::show('cart');
        $total = 0;
        $all = input()->all();

        foreach ($cart as $cart2) {
            $total += $cart2->price*$cart2->qtd;
            $res = (new Order())->insert($cart2->id, $cart2->idsession, $cart2->qtd, $all['address'], $all['district'], $all['city'], $all['number'], $all['complement'], $all['payment'], $date);
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
        if (Session::has('cart') == false) {
            redirect(url('home'));
        }

        $cart = Session::show('cart');
        $total = 0;
        foreach ($cart as $cart2) {
            $total += $cart2->price*$cart2->qtd;
        }

        Wolf::loadView('view.site.finished', [
            'title' => 'Pedido finalizado',
            'cart' => $cart,
            'total' => $total
        ]);

        Session::delete('cart');
    }
}