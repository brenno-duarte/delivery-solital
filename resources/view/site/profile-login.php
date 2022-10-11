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
        <div class="col-md-6">

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

            <form action="<?= url('profile.login.post') ?>" id="login-form-wrap" class="login" method="post">
                <h2>Acessar</h2>

                <?= csrf_token(90) ?>

                <div class="form-group row mt-4">
                    <label for="email" class="col-sm-2">E-mail</label>
                    <div class="col-sm-10">
                        <input type="text" id="email" name="email" class="form-control ml-1" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="senha" class="col-sm-2">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" id="senha" name="password" class="form-control ml-1" required>
                    </div>
                </div>

                <div class="form-row form-check">
                    <input type="checkbox" value="forever" id="rememberme" name="rememberme" class="form-check-input">
                    <label for="rememberme" class="form-check-label">Manter conectado</label>
                </div>

                <div class="form-row mt-3">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div class="col-sm-10">
                        <a href="#">Esqueceu a senha?</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">

            <!-- MSG ERRO -->

            <form id="register-form-wrap" action="<?= url('profile.create.post') ?>" class="register" method="POST">
                <h2>Criar conta</h2>

                <?= csrf_token(90) ?>

                <div class="form-group row mt-4">
                    <label for="nome" class="col-sm-2">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" id="nome" name="name" class="form-control ml-1" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2">Telefone</label>
                    <div class="col-sm-10">
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="senha" class="col-sm-2">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" id="senha" name="password" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <button type="submit" class="btn btn-primary">Criar Conta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>