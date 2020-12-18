<?php include('header.php'); ?>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4 mb-5">

                <div class="text-center text-success" style="font-size: 140px;">
                    <i class="far fa-check-circle"></i>
                </div>

                <div class="text-center">
                    <h1 class="h3">Compra finalizada</h1>

                    <p>Sua compra foi finalizada com successo, por favor aguarde que
                        seu produto chegará em instantes</p>
                </div>

                <p class="h3 mt-5">Detalhes do Pedido</p>
                <table class="table table-bordered text-center mt-3">
                    <thead>
                        <tr class="bg-light text-uppercase">
                            <th scope="col">Produto</th>
                            <th scope="col">Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $cart) : ?>
                            <tr>
                                <td class="align-middle">
                                    <?= $cart->name; ?>
                                    <span class="font-weight-bold h5">(x<?= $cart->qtd; ?>)</span>
                                </td>
                                <td class="align-middle price" id="price">
                                    R$ <span><?= $cart->price * $cart->qtd; ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="bg-light text-uppercase align-middle">Total do Pedido</th>
                            <td><strong><span class="font-1 align-middle">R$ <?= $total; ?></span></strong></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="text-center">
                    <a href="<?= url('home'); ?>" class="btn btn-warning">Voltar para a loja</a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('footer-cart.php'); ?>