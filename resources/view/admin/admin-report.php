<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <p class="p-4 display-4 font-weight-normal"><?= $title ?></p>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="card-deck p-4">
            <div class="card bg-3 ticket">
                <div class="mb-3 form-inline p-3">
                    <div class="col-md-6 col-sm-12 text-center h1">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center">
                        <p class="h6 mt-3">Produtos Entregues</p>
                        <p class="h1"><?= $received ?></p>
                    </div>
                </div>
            </div>

            <div class="card bg-4 ticket">
                <div class="mb-3 form-inline p-3">
                    <div class="col-md-6 text-center h1">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="col-md-6 text-center">
                        <p class="h6 mt-3">Produtos Retornados</p>
                        <p class="h1"><?= $return ?></p>
                    </div>
                </div>
            </div>

            <div class="card bg-1 ticket">
                <div class="mb-3 form-inline p-3">
                    <div class="col-md-6 text-center h1">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="col-md-6 text-center">
                        <p class="h6 mt-3">Produtos cadastrados</p>
                        <p class="h1"><?= $products ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12 d-flex justify-content-end mt-5 mb-3">
        <form action="<?= url('report.custom') ?>" method="get" class="form-inline">
            <div class="form-group">
                <input type="date" name="search" class="input-class mr-2">
            </div>

            <button type="submit" class="btn btn-1">
                <i class="fas fa-search"></i>
                Pesquisar
            </button>
        </form>
    </div>

    <div class="col-md-12">
        <table class="table table-action">
            <thead>
                <tr>
                    <th>Faturamento</th>
                    <th>Valor</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Do mês <?= date('m/Y') ?> </td>
                    <td>R$ <?= $billingMonth ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>R$ <?= $billingTotal ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>