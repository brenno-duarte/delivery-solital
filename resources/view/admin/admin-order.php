<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="p-4 display-4"><?= $title; ?></h1>
    </div>
</div>

<section class="content">
    <div class="row mb-3">
        <div class="col-md-6">
            <?php if ($title == "Pedidos") : ?>
                <a href="<?= url('send.order'); ?>" class="btn btn-1">
                    <i class="fas fa-paper-plane"></i> Ver pedidos enviados
                </a>
            <?php elseif ($title == "Pedidos enviados") : ?>
                <a href="<?= url('order'); ?>" class="btn btn-1">
                    <i class="fas fa-exclamation-circle"></i> Ver pedidos em aberto
                </a>
            <?php endif; ?>
        </div>

        <div class="col-md-6 d-flex justify-content-end">
            <form action="#" method="get">
                <input type="text" placeholder="&#xf002; Search..." class="input-search">
            </form>
        </div>
    </div>

    <?php if ($msg1) : ?>
        <div class="txt-3 text-center font-2 mb-3 mt-4 col-md-12">
            <i class="fas fa-check-circle"></i>
            <?= $msg1; ?>
        </div>
    <?php endif; ?>

    <?php if ($msg2) : ?>
        <div class="txt-3 text-center font-2 mb-3 mt-4 col-md-12">
            <i class="fas fa-check-circle"></i>
            <?= $msg2; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-action">
                <thead>
                    <tr>
                        <th>Data do pedido</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($rows) : ?>
                        <?php foreach ($rows as $order) : ?>
                            <tr>
                                <td><?= date('d/m/Y à\\s H:i:s', strtotime($order['created_at'])) ?></td>
                                <?php if ($title == "Pedidos") : ?>
                                    <td class="txt-4 font-weight-bold"><?= $order['order_status'] ?></td>
                                <?php elseif ($title == "Pedidos enviados") : ?>
                                    <td class="txt-1 font-weight-bold"><?= $order['order_status'] ?></td>
                                <?php endif; ?>
                                <td>
                                    <a href="<?= url('order.details', ['id' => $order['idSession']]); ?>" class="btn btn-5 mr-3">
                                        <i class="fas fa-search"></i> Detalhes
                                    </a>
                                    <a href="<?= url('edit.status', ['id' => $order['idSession']]); ?>" class="btn btn-1 mr-3">
                                        <i class="fas fa-edit"></i> Status
                                    </a>
                                    <?php if ($title == "Pedidos") : ?>
                                        <a href="<?= url('delete.order', ['id' => $order['idSession']]); ?>" class="btn btn-4" onclick="return confirm('Deseja realmente excluir este pedido?')">
                                            <i class="fas fa-trash-alt"></i> Excluir
                                        </a>
                                    <?php elseif ($title == "Pedidos enviados") : ?>
                                        <a href="<?= url('delivered.order', ['id' => $order['idSession']]); ?>" class="btn btn-3" onclick="return confirm('Este pedido será marcado como entregue, continuar?')">
                                            <i class="fas fa-check"></i> Marcar como Entregue
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td><span>Não foram encontrado resultados</span></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-5 d-flex justify-content-center">
            <?= $arrows; ?>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>