<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="row bg-warning">
        <div class="col-md-12 col-sm-12">
            <div class="text-center p-4">
                <p class="display-4">Carrinho de Compras</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="<?= url('checkout'); ?>" method="POST">
                <?= csrf_token(); ?>

                <?php if ($msg1) : ?>
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        <strong><?= $msg1; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if ($msg2) : ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong><?= $msg2; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if ($cart != null) : ?>
                    <table class="table table-bordered text-center mt-3">
                        <thead class="text-uppercase font-weight-bold">
                            <tr>
                                <th scope="col">&nbsp;</th>
                                <th scope="col">&nbsp;</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $cart) : ?>
                                <!-- <input type="text" name="idProduct[]" value="?= $cart->idProduct ?>" required readonly> -->

                                <tr>
                                    <td class="align-middle">
                                        <a title="Remover este item" href="<?= url('remove', ['idProduct' => $cart->idProduct]); ?>">
                                            <i class="fas fa-window-close text-danger font-1"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <img class="" width="145" height="145" src="<?= self::loadImg("/fotos/" . $cart->mainPhoto); ?>">
                                    </td>

                                    <td class="align-middle"><?= $cart->nameProduct; ?></td>
                                    <td class="align-middle price" id="price">
                                        R$ <span><?= format_price($cart->price) ?></span>
                                    </td>

                                    <td class="align-middle text-center">
                                        <div class="form-inline align-middle">
                                            <?php if ($cart->qtd == 1) : ?>
                                                <input type="button" value="-" disabled id="decrease" class="btn btn-warning offset-md-3 decrease">
                                            <?php else : ?>
                                                <input type="button" value="-" id="decrease" class="btn btn-warning offset-md-3 decrease" onclick="window.location.href = '<?= url('decrease', ['idProduct' => $cart->idProduct, 'qtd' => $cart->qtd]); ?>'">
                                            <?php endif; ?>
                                            <input type="number" name="qtd" value="<?= $cart->qtd; ?>" id="qtd" class="form-control align-middle col-md-3 qtd" readonly>
                                            <button type="button" class="btn btn-warning" onclick="window.location.href = '<?= url('increase', ['idProduct' => $cart->idProduct, 'qtd' => $cart->qtd]); ?>'">+</button>
                                        </div>
                                    </td>

                                    <td class="align-middle text-success font-weight-bold subtotal">
                                        R$ <?= format_price($cart->price * $cart->qtd) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <?php if ($cart) : ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-group mt-5 mb-4 mx-auto">
                                <div class="card border-0">
                                    <h2>Calcular Frete</h2>

                                    <div class="form-row mt-4">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="cepShipping" class="sr-only"></label>
                                            <input type="text" maxlength="9" class="form-control" id="cepShipping" name="cepShipping" placeholder="Digite seu CEP" value="<?= ($profile_address['cep'] ?? "") ?>">
                                        </div>
                                        <input class="btn btn-primary mb-2" type="submit" formmethod="get" formaction="<?= url('cep.shipping') ?>" value="Atualizar CEP" class="button">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card-group mt-5 mb-4 mx-auto">
                                <div class="card border-0">
                                    <h2>Resumo da Compra</h2>

                                    <input type="hidden" name="subtotal" id="subtotal" value="<?= format_price($total) ?>" required readonly>
                                    <!-- <input type="text" name="valorFrete" id="valorFrete" value="?= ($_SESSION['valorFrete'] ?? "") ?>" required readonly>
                                    <input type="text" name="prazoEntrega" id="prazoEntrega" value="?= ($_SESSION['PrazoEntrega'] ?? "") ?>" required readonly>
                                    <input type="text" name="amount" id="amount" value="?= (format_price(str_replace("R$ ", "", $_SESSION['total'])) ?? "") ?>" required readonly> -->

                                    <table cellspacing="0" class="table table-bordered mt-4">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th class="bg-light">Subtotal</th>
                                                <td>
                                                    <span class="float-right h5" id="subtotal">
                                                        R$ <?= format_price($total) ?>
                                                    </span>
                                                </td>
                                            </tr>

                                            <?php if (!empty($freight->freightValue) && !empty($freight->days)) : ?>
                                                <tr class="cart-subtotal">
                                                    <th class="bg-light">Frete</th>
                                                    <td><span class="float-right h5" id="valorFrete">R$ <?= ($freight->freightValue ?? "") ?></span></td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th class="bg-light">Prazo de entrega</th>
                                                    <td><span class="float-right h5" id="PrazoEntrega"><?= ($freight->days ?? "") ?> dia(s)</span></td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th class="bg-light">Total</th>
                                                    <td>
                                                        <span class="amount font-weight-bold h3 float-right">
                                                            R$ <span id="totalPrice"><?= (format_price($total + $freight->freightValue) ?? "") ?></span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($freight->freightValue) && !empty($freight->days)) : ?>
                        <button type="submit" class="btn btn-warning mb-5 float-right">Ir para pagamento</button>
                    <?php endif; ?>

                <?php else : ?>
                    <div class="text-center text-primary mt-5" style="font-size: 100px;">
                        <i class="fas fa-shopping-cart"></i>
                    </div>

                    <div class="text-center mb-5">
                        <h1 class="h3">Seu carrinho esta vazio</h1>

                        <p class="mt-3">Você ainda não adicionou nenhum item no seu carrinho</p>
                    </div>

                    <div class="text-center">
                        <a href="<?= url('home'); ?>" class="btn btn-warning">Voltar para a loja</a>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<?php include('footer-cart.php'); ?>