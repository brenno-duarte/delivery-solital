<?php

namespace Solital\Components\Controller\Auth;

use Solital\Components\Controller\Auth\AuthController;
use Solital\Components\Model\Order;
use Solital\Components\Model\Analytics;
use Solital\Core\Resource\Message;
use Solital\Core\Security\Guardian;
use Solital\Core\Wolf\Wolf;

class LoginController extends AuthController
{
    /**
     * @return void
     */
    public function login(): void
    {
        Guardian::checkLogged();

        Wolf::loadView('auth/login', [
            'title' => 'Login',
            'msg1' => Message::get('errorLogin'),
            'msg2' => Message::get('change')
        ]);

        Message::clear('errorLogin');
        Message::clear('change');
    }

    /**
     * @return void
     */
    public function verify(): void
    {
        $res = $this->columns('username', 'pass')
            ->values('email', 'pass')
            ->register('tb_auth');

        if ($res == false) {
            Message::new('errorLogin', 'Usuário e/ou senha incorretos');
            response()->redirect(url('login'));
        }
    }

    /**
     * @return void
     */
    public function dashboard(): void
    {
        Guardian::checkLogin();
        $order = new Order();

        Wolf::loadView('view.admin.admin-dashboard', [
            'title' => 'Dashboard',
            'report' => (new Analytics())->list(),
            'newOrder' => $order->pagination(),
            'sendOrder' => $order->sendPagination()
        ]);
    }

    /**
     * @return void
     */
    public function exit(): void
    {
        Guardian::logoff();
    }
}
