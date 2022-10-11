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
            <div class="cart-collaterals">
                <h2>Alterar Senha</h2>
            </div>

            <?php if ($msg1) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $msg1 ?>
                </div>
            <?php endif; ?>

            <?php if ($msg2) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $msg2 ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('profile.pass.post') ?>" method="POST">
                <?= csrf_token(90) ?>

                <div class="form-group">
                    <label for="current_pass">Senha Atual</label>
                    <input type="password" class="form-control" id="current_pass" name="current_pass">
                </div>

                <div class="form-group">
                    <label for="new_pass">Nova Senha</label>
                    <input type="password" class="form-control" id="new_pass" name="new_pass">
                </div>

                <div class="form-group">
                    <label for="new_pass_confirm">Confirme a Nova Senha</label>
                    <input type="password" class="form-control" id="new_pass_confirm" name="new_pass_confirm">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>