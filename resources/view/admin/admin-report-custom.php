<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <p class="p-4 display-4 font-weight-normal"><?= $title ?></p>
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
                    <td>Do mês <?= date('m/Y', strtotime($search)) ?> </td>
                    <td>R$ <?= $billingMonth ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>