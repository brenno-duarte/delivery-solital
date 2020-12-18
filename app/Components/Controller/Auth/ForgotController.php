<?php

namespace Solital\Components\Controller\Auth;

use Solital\Components\Model\Forgot;
use Solital\Core\Resource\Message;
use Solital\Core\Security\Guardian;
use Solital\Core\Wolf\Wolf;
use Solital\Core\Security\Hash;
use Solital\Core\Security\Reset;

class ForgotController
{
    public function forgot()
    {
        Guardian::checkLogged();

        Wolf::loadView('auth.forgot', [
            'title' => 'Recuperar senha',
            'msg' => Message::get('forgot')
        ]);

        Message::clear('forgot');
    }

    public function change($hash)
    {
        $res = Hash::decrypt($hash)::isValid();

        if ($res == true) {
            $email = Hash::decrypt($hash)::value();

            Wolf::loadView('auth.change', [
                'title' => 'Alterar senha',
                'email' => $email,
                'hash' => $hash,
                'msg' => Message::get('pass')
            ]);

            Message::clear('pass');

        } else {
            response()->redirect(url('login'));
        }
    }

    public function forgotPost()
    {
        $email = input()->post('email')->getValue();

        $res = (new Reset())->table('tb_auth', 'username')->forgotPass($email, '/admin/change');

        if ($res == true) {
            Message::new('forgot', 'Foi enviado um link para o seu e-mail para recuperação de senha');
            response()->redirect(url('forgot'));
        }
    }

    public function changePost($hash)
    {
        $res = Hash::decrypt($hash)::isValid();
        $email = Hash::decrypt($hash)::value();

        if ($res == true) {
            $pass = input()->post('pass')->getValue();
            $confPass = input()->post('confPass')->getValue();

            if ($pass != $confPass) {
                Message::new('pass', 'As senhas não correspondem');
                response()->redirect('/admin/change/'.$hash);
            } else {
                $res = (new Forgot())->update(pass_hash($pass), $email);

                if ($res = true) {
                    Message::new('change', 'Senha alterada com sucesso');
                    response()->redirect(url('login'));
                }
            }
        } else {
            response()->redirect(url('login'));
        }
    }

}