<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use Solital\Core\Resource\Message;
use Solital\Components\Model\Order;
use Solital\Components\Model\Setting;
use Solital\Core\Security\Guardian;

class OrderController
{
    /**
     * @return void
     */
    public function order(): void
    {
        Guardian::checkLogin();
        $pag = (new Order())->pagination();

        if ($pag['rows'] == null) {
            remove_param();
        }

        Wolf::loadView('view.admin.admin-order', [
            'title' => 'Pedidos',
            'rows' => $pag['rows'],
            'arrows' => $pag['arrows'],
            'msg1' => Message::get('editStatus'),
            'msg2' => Message::get('delOr')
        ]);

        Message::clear('editStatus');
        Message::clear('delOr');
    }

    /**
     * @return void
     */
    public function sendOrder(): void
    {
        Guardian::checkLogin();
        $pag = (new Order())->sendPagination();

        if ($pag['rows'] == null) {
            remove_param();
        }

        Wolf::loadView('view.admin.admin-order', [
            'title' => 'Pedidos enviados',
            'rows' => $pag['rows'],
            'arrows' => $pag['arrows'],
            'msg1' => Message::get("delivered"),
            'msg2' => ''
        ]);

        Message::clear("delivered");
    }

    /**
     * @param string $id
     * @return void
     */
    public function orderDetails($id): void
    {
        Guardian::checkLogin();
        remove_param();
        $order = (new Order())->list($id);
        $photo = (new Setting())->list();
        $total = 0;
        
        foreach ($order as $order2) {
            $total += $order2['price'] * $order2['qtd'];   
        }
        
        Wolf::loadView('view.admin.admin-detail-order', [
            'title' => 'Detalhes do pedido',
            'order' => $order,
            'photo' => $photo['logo'],
            'total' => $total
        ]);
    }

    /**
     * @param string $id
     * @return void
     */
    public function editStatus($id): void
    {
        Guardian::checkLogin();
        remove_param();

        Wolf::loadView('view.admin.admin-edit-status', [
            'title' => 'Editar status do pedido',
            'order' => (new Order())->list($id)
        ]);
    }

    /**
     * @param string $id
     * @return void
     */
    public function editStatusPost($id): void
    {
        Guardian::checkLogin();
        remove_param();
        $status = input()->post('status')->getValue();
        
        $res = (new Order())->update($status, $id);
        
        if ($res == true) {
            Message::new('editStatus', 'Status alterado com sucesso');
            response()->redirect(url('order'));
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function deliveredOrder($id)
    {
        Guardian::checkLogin();
        remove_param();
        
        $res = (new Order())->update("Entregue", $id);
        
        if ($res == true) {
            Message::new('delivered', 'Pedido marcado como entregue');
            response()->redirect(url('send.order'));
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function deleteOrder($id): void
    {
        Guardian::checkLogin();
        $res = (new Order())->delete($id);
        
        Message::new('delOr', 'Pedido deletado com sucesso');
        response()->redirect(url('order'));
    }
}