<?php include('header.php'); ?>

<div class="row mb-5">
    <div class="col-md-12">
        <p class="p-4 display-4">Dashboard</p>
    </div>
    <?php if(is_array($newOrder['rows'])): ?>
    <div class="col-md-4 mt-3">
        <div class="card bg-4 ticket">
            <div class="mb-3 form-inline">
                <div class="col-md-6 col-sm-12 text-center h1">
                    <i class="fas fa-exclamation"></i>
                </div>
                <div class="col-md-6 col-sm-12 text-center">
                    <p class="h1 mt-4"><?= count($newOrder['rows']) ?></p>
                    <p class="h6">Pedido(s) pendente(s)</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(is_array($sendOrder['rows'])): ?>
    <div class="col-md-4 mt-3">
        <div class="card bg-1 ticket">
            <div class="mb-3 form-inline">
                <div class="col-md-6 col-sm-12 text-center h1">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="col-md-6 col-sm-12 text-center">
                    <p class="h1 mt-4"><?= count($sendOrder['rows']) ?></p>
                    <p class="h6">Pedido(s) enviado(s)</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-12">
        <p class="h4 font-weight-normal">Mais acessadas de hoje: <?= date('d/m/Y') ?></p>
        <table class="table table-action">
            <thead>
                <tr>
                    <th>URL</th>
                    <th>visualizações</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($report as $report): ?>
                <tr>
                    <td><?= $report['url'] ?></td>
                    <td><?= $report['views'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($report['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>