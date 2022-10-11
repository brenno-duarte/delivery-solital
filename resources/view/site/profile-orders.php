<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="row bg-warning">
        <div class="col-md-12">
            <div class="text-center p-4">
                <h1><?= $title ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-3">
            <?php include('profile-menu.php'); ?>
        </div>
        <div class="col-md-9">
            <div>
                <h2>Meus Pedidos</h2>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Valor Total</th>
                        <th>Status</th>
                        <th>Endereço</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    {loop="$orders"}
                    <tr>
                        <th scope="row">{$value.idorder}</th>
                        <td>R${function="formatPrice($value.vltotal)"}</td>
                        <td>{$value.desstatus}</td>
                        <td>{$value.desaddress}, {$value.desdistrict}, {$value.descity} - , {$value.desstate} CEP: {$value.deszipcode}</td>
                        <td style="width:222px;">
                            <a class="btn btn-success" href="/payment/{$value.idorder}" role="button">Imprimir Boleto</a>
                            <a class="btn btn-default" href="/profile/orders/{$value.idorder}" role="button">Detalhes</a>
                        </td>
                    </tr>
                    {else}
                    <div class="alert alert-info">
                        Nenhum pedido foi encontrado.
                    </div>
                    {/loop}
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>