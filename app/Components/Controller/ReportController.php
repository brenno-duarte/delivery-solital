<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use Solital\Core\Security\Guardian;
use Solital\Components\Model\Order;
use Solital\Components\Model\Product;
use Solital\Components\Model\Report;

class ReportController
{
    /**
     * @var int
     */
    private $billing = 0;

    /**
     * @var int
     */
    private $billingMonth = 0;

    /**
     * Costruct
     */
    public function __construct()
    {
        Guardian::checkLogin();
    }

    /**
     * @return void
     */
    public function report(): void
    {
        $report = new Report();
        $pag = (new Order())->receivedPagination();
        $return = (new Order())->returned();
        $products = (new Product())->listAll();

        if ($pag['rows'] != '') {
            $received = count($pag['rows']);
        } else {
            $received = 0;
        }

        foreach ($report->billingTotal() as $billing) {
            $this->billing += $billing['price'];
        }

        foreach ($report->billingMonth() as $billingMonth) {
            $this->billingMonth += $billingMonth['price'];
        }

        Wolf::loadView('view.admin.admin-report', [
            'title' => 'Relatório',
            'rows' => $pag['rows'],
            'arrows' => $pag['arrows'],
            'received' => $received,
            'return' => count($return),
            'products' => count($products),
            'billingTotal' => $this->billing,
            'billingMonth' => $this->billingMonth
        ]);
    }

    /**
     * @return void
     */
    public function reportCustom(): void
    {
        $search = input()->get('search')->getValue();

        foreach ((new Report())->billingMonth(date('m')) as $billingMonth) {
            $this->billingMonth += $billingMonth['price'];
        }

        Wolf::loadView('view.admin.admin-report-custom', [
            'title' => 'Relatório Personalizado',
            'search' => $search,
            'billingMonth' => $this->billingMonth
        ]);
    }
}
