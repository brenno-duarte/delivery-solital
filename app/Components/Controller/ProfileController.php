<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use Solital\Components\Model\Cep;
use Solital\Components\Model\Cart;
use Solital\Core\Resource\Message;
use Solital\Core\Resource\Session;
use Solital\Components\Model\Profile;
use Solital\Components\Model\CartFreight;
use Solital\Components\Controller\Auth\AuthController;

class ProfileController extends AuthController
{
    /**
     * @var mixed
     */
    private $cart;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->cart = (new Cart())->listCart();
    }

    /**
     * @return void
     */
    public function profileLogin(): void
    {
        if (Session::has('solital_index_profile')) {
            response()->redirect(url('profile'));
        }

        Wolf::loadView('view.site.profile-login', [
            'title' => 'Fazer Login',
            'msg1' => Message::get('profile.login.error'),
            'msg2' => Message::get('profile.login.success'),
            'cart' => $this->cart
        ]);

        Message::clear('profile.login.error');
        Message::clear('profile.login.success');
    }

    /**
     * @return void
     */
    public function profileLoginPost(): void
    {
        $res = $this->columns('email', 'password')
            ->values('email', 'password')
            ->register('tb_profile', url('profile'));

        if ($res == false) {
            Message::new('profile.login.error', 'Usuário e/ou senha incorretos');
            response()->redirect(url('profile.login'));
        }
    }

    /**
     * @return void
     */
    public function profileCreatePost(): void
    {
        $values = input()->all();

        $res = (new Profile())->insert(
            $values['name'],
            $values['email'],
            $values['phone'],
            pass_hash($values['password'])
        );

        Session::new('solital_index_profile', $values['email']);
        Session::new('last_id', $res['lastId']);

        Message::new('profile.alert.sucess', 'Conta criada com sucesso!');
        response()->redirect(url('profile'));
    }

    /**
     * @return void
     */
    public function profile(): void
    {
        (new Profile())->verifyLogin();

        $cart = Session::show('cart');
        $idProfile = Session::show('last_id');

        if ($cart || isset($cart)) {
            foreach ($cart as $cart) {
                (new Cart())->insert((int)$cart->idProduct, (int)$idProfile, (int)$cart->qtd);
            }

            if (Session::show('valorFrete') && Session::show('PrazoEntrega') && Session::show('total')) {
                (new CartFreight())->insert(
                    (int)$idProfile,
                    Session::show('valorFrete'),
                    (int)Session::show('PrazoEntrega'),
                    Session::show('total')
                );

                Session::delete('valorFrete');
                Session::delete('PrazoEntrega');
                Session::delete('total');
            }

            Session::delete('cart');
        }

        Wolf::loadView('view.site.profile', [
            'title' => 'Minha Conta',
            'profile' => (new Profile())->list((int)$idProfile),
            'profile_address' => (new Cep())->listAddress((int)$idProfile),
            'msg1' => Message::get('profile.alert.sucess'),
            'cart' => $this->cart
        ]);

        Message::clear('profile.alert.sucess');
    }

    /**
     * @return void
     */
    public function profilePost(): void
    {
        (new Profile())->verifyLogin();

        $values = input()->all();

        (new Profile())->update(
            $values['profileName'],
            $values['profileEmail'],
            $values['profilePhone'],
            (int)Session::show('last_id')
        );

        Message::new('profile.alert.sucess', 'Informações atualizadas com sucesso!');
        response()->redirect(url('profile'));
    }

    /**
     * @return void
     */
    public function profilePass(): void
    {
        (new Profile())->verifyLogin();

        Wolf::loadView('view.site.profile-change-password', [
            'title' => 'Minha Conta',
            'msg1' => Message::get('profile.pass.error'),
            'msg2' => Message::get('profile.pass.success'),
            'cart' => $this->cart
        ]);

        Message::clear('profile.pass.error');
        Message::clear('profile.pass.success');
    }

    /**
     * @return void
     */
    public function profilePassPost(): void
    {
        (new Profile())->verifyLogin();

        $current_pass = input()->post('current_pass')->getValue();
        $new_pass = input()->post('new_pass')->getValue();
        $new_pass_confirm = input()->post('new_pass_confirm')->getValue();

        $id = Session::show('last_id');

        $user = (new Profile())->list((int)$id);

        if ($new_pass != $new_pass_confirm) {
            Message::new('profile.pass.error', 'O campo "Nova Senha" é diferente do campo "Confirmar senha"!');
            response()->redirect(url('profile.pass'));
        }

        if (pass_verify($current_pass, $user['password'])) {
            (new Profile())->updatePass(pass_hash($new_pass), $id);
            Message::new('profile.pass.success', 'Senha alterada com sucesso!');
        } else {
            Message::new('profile.pass.error', 'Sua senha atual está errada!');
        }

        response()->redirect(url('profile.pass'));
    }

    /**
     * @return void
     */
    public function profileOrders(): void
    {
        (new Profile())->verifyLogin();

        Wolf::loadView('view.site.profile-orders', [
            'title' => 'Minha Conta',
            'cart' => $this->cart
        ]);
    }

    /**
     * @return void
     */
    public function profileLogout(): void
    {
        /* Session::delete('valorFrete');
        Session::delete('PrazoEntrega');
        Session::delete('total'); */
        Session::delete('last_id');
        Session::delete('solital_index_profile');

        Message::new('profile.login.success', 'Você saiu com sucesso. Volte logo!');
        response()->redirect(url('profile.login'));
    }
}
