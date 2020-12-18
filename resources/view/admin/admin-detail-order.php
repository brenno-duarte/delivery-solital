<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="p-4 display-4">Detalhes do pedido</h1>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <section class="invoice bg-white rounded p-3" id="printArea">
                <!-- title row -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="page-header h5">
                            <img src="<?= self::loadImg( $photo ) ?>" class="img-fluid" width="170">
                            <small class="float-right">Data: <?= date('d/m/Y') ?></small>
                        </p>
                    </div>
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <strong>De</strong>
                        <address>
                            <strong>HCODE</strong><br>
                            Rua Ademar Saraiva Leão, 234 - Alvarenga<br>
                            São Bernardo do Campo - SP<br>
                            Telefone: (11) 3171-3080<br>
                            E-mail: suporte@hcode.com.br
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <strong>Destinatário</strong>
                        <address>
                            <?= $order[0]['address'] ?>, <?= $order[0]['complement'] ?><br>
                            <?= $order[0]['city'] ?><br>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Pedido #<?= $order[0]['idOrder'] ?></b><br>
                        <br>
                        <b>Emitido em:</b> <?= date('d/m/Y à\\s H:i',  strtotime($order[0]['created_at'])) ?><br>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row mt-3">
                    <div class="col-md-12 table-responsive w-100">
                        <p class="lead">Pedidos</p>
                        <table class="table table-action">
                            <thead>
                                <tr>
                                    <th>Quantidade</th>
                                    <th>Produto</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($order as $order): ?>
                                <tr>
                                    <td><?= $order['qtd'] ?></td>
                                    <td><?= $order['nameProduct'] ?></td>
                                    <td>R$ <?= $order['price'] * $order['qtd'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-6">
                        <p class="lead">Forma de Pagamento</p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="font-weight-bold">Método de Pagamento:</th>
                                    <td><?= $order['payment'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-6">
                        <p class="lead">Resumo do Pedido</p>
                        <!-- <div class="table-responsive"> -->
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="font-weight-bold">Total:</th>
                                        <td>R$ <?= $total ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- </div> -->
                    </div>
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" onclick="printArea('printArea')" class="btn btn-primary float-right">
                            <i class="fa fa-print"></i> Imprimir
                        </button>
                    </div>
                </div>
            </section>

            <div class="clearfix"></div>

                <div class="mt-5 mb-5 d-flex justify-content-center form-inline">
                    <button class="btn btn-3 mr-3" type="submit">
                        <i class="fas fa-check-circle"></i> Salvar
                    </button>

                    <a href="javascript:history.back();" class="btn btn-1">
                        <i class="fas fa-arrow-circle-left"></i> Voltar
                    </a>
                </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>