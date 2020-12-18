<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="p-4 display-4"><?= $title; ?></h1>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-signin mt-3" method="POST" action="<?= url('edit.status.post', ['id' => $order[0]['idSession']]); ?>">
                <?= csrf_token(); ?>

                <div class="form-group">
                    <label for="status">Status do pedido</label>
                    <select id="status" class="select-class" name="status" required>
                        <option value="<?= $order[0]['order_status']; ?>" selected><?= $order[0]['order_status']; ?> (Status atual)</option>
                        <option value="Enviado">Enviado</option>
                        <option value="Recebido">Recebido</option>
                        <option value="Retornado">Retornado</option>
                    </select>
                </div>

                <div class="mt-5 d-flex justify-content-center form-inline">
                    <button class="btn btn-3 mr-3" type="submit">
                        <i class="fas fa-check-circle"></i> Salvar
                    </button>

                    <a href="javascript:history.back();" class="btn btn-1">
                        <i class="fas fa-arrow-circle-left"></i> Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>