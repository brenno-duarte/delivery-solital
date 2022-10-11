<?php

namespace Solital\Components\Controller;

use CorreiosAPI\CorreiosAPI;
use Solital\Components\Model\Cart;
use Solital\Components\Model\CartFreight;
use Solital\Components\Model\Cep;
use Solital\Components\Model\Profile;
use Solital\Core\Resource\Message;
use Solital\Core\Resource\Session;

class CepController
{
    /**
     * Construct
     */
    public function __construct()
    {
        #(new Profile())->verifyLogin();
    }

    /**
     * @return void
     */
    public function searchCep(): void
    {
        $cep = input()->get('cep')->getValue();
        $res = (new CorreiosAPI())->buscaCEP($cep);

        echo json_encode($res);
    }

    /**
     * @return void
     */
    public function addressCepPost(): void
    {
        $cep = new Cep();

        $values = input()->all();
        $idProfile = Session::show('last_id');
        $res = $cep->listAddress($idProfile);

        if ($res) {
            $cep->update(
                (int)$idProfile,
                $values['cep'],
                $values['address'],
                $values['district'],
                $values['city'],
                $values['state'],
                (int)$values['number'],
                $values['complement'],
                (int)$res['idAddress']
            );
        } else {
            $cep->insert(
                (int)$idProfile,
                $values['cep'],
                $values['address'],
                $values['district'],
                $values['city'],
                $values['state'],
                (int)$values['number'],
                $values['complement']
            );
        }

        Message::new('profile.alert.sucess', 'Informações de endereço atualizadas com sucesso!');
        response()->redirect(url('profile'));
    }

    /**
     * @param string $cep
     * 
     * @return void
     */
    public function calculateShipping(): void
    {
        $cep = input()->get('cepShipping')->getValue();
        $subtotal = input()->get('subtotal')->getValue();

        $cartfreight = new CartFreight();
        #$cep = str_replace("-", "", $cep);
        $idProfile = Session::show('last_id');

        $listSum = (new Cart())->listSum((int)$idProfile);

        $res = (new CorreiosAPI())->calcPrecoPrazo(
            '04510',
            '23545037',
            str_replace("-", "", $cep),
            $listSum['totalWeight'],
            3,
            $listSum['totalWidth'],
            $listSum['totalHeight'],
            $listSum['totalLength'],
            0
        );

        if ($res->error) {
            Message::new('cart.alert.error', 'Erro ao calcular o frete. Código: ' . $res->codeError);
            redirect(url('cart'));
        }

        $freight = (string)$res->cServico->Valor;
        $days = (string)$res->cServico->PrazoEntrega;
        $subtotal = format_number($subtotal);
        $freight = format_number($freight);

        $totalFreight = $subtotal + $freight;

        if (Session::show('solital_index_profile')) {
            $res = $cartfreight->listAll((int)$idProfile);

            if ($res || !empty($res)) {
                $cartfreight->update((int)$idProfile, $freight, (int)$days, $totalFreight);
            } else {
                $cartfreight->insert((int)$idProfile, $freight, (int)$days, $totalFreight);
            }
        } else {
            Session::new("cartfreight", [
                'idsession' => session_id(),
                'idProfile' => $idProfile,
                'freight' => $freight,
                'days' => $days,
                'totalFreight' => $totalFreight
            ]);
        }

        Message::new('cart.alert.success', 'Frete atualizado!');
        response()->redirect(url('cart'));
    }
}
