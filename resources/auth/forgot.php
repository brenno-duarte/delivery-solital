<?php include('header-login.php'); ?>

<div class="card login bg-white">
    <div class="card-body">
        <h2 class="text-center txt-5"><i class="fa fa-user"></i> Recuperar senha</h2>
        <form class="form-signin mt-4" method="POST" action="<?= url('forgotPost') ?>">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
            
            <?php if ($msg) : ?>
                <div class="txt-3 text-center font-2 m-4">
                    <i class="fas fa-check-circle"></i>
                    <?= $msg ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <input type="email" id="email" class="input-class" name="email" placeholder="Digite seu e-mail" required autofocus>
            </div>

            <div class="row form-inline mt-4">
                <div class="col-md-12">
                    <button class="btn btn-g btn-1 btn-block font-weight-bold" type="submit">
                        <i class="fas fa-paper-plane"></i> Enviar
                    </button>
                </div>

                <div class="col-md-12 d-flex justify-content-center mt-4">
                    <a href="javascript:history.back();" class="txt-1">Voltar e fazer login</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('footer-login.php'); ?>