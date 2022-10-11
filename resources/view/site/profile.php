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

<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-3">
            <?php include('profile-menu.php'); ?>
        </div>
        <div class="col-md-9">

            <?php if ($msg1) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $msg1 ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= url('profile.post') ?>">
                <?= csrf_token(120) ?>

                <h2>Dados pessoais</h2>

                <div class="form-group mt-3">
                    <label for="profileName">Nome completo</label>
                    <input type="text" class="form-control" id="profileName" name="profileName" placeholder="Digite o nome aqui" value="<?= $profile['name'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="profileEmail">E-mail</label>
                    <input type="email" class="form-control" id="profileEmail" name="profileEmail" placeholder="Digite o e-mail aqui" value="<?= $profile['email'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="profilePhone">Telefone</label>
                    <input type="tel" class="form-control" id="profilePhone" name="profilePhone" placeholder="Digite o telefone aqui" value="<?= $profile['phone'] ?>" required>
                </div>

                <input type="hidden" name="profilePass" placeholder="Digite o telefone aqui" value="<?= $profile['password'] ?>" required>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>

            <form action="<?= url('cep.address.post') ?>" method="POST" class="mt-4">
                <?= csrf_token(120) ?>

                <h2>Endereço de entrega</h2>

                <div class="form-row mt-4">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="cep" class="sr-only"></label>
                        <input type="text" maxlength="9" class="form-control" id="cep" name="cep" placeholder="Digite seu CEP" value="<?= ($profile_address['cep'] ?? "") ?>">
                    </div>
                    <button type="button" id="loadCep" class="btn btn-primary mb-2">Atualizar CEP</button>
                </div>

                <div class="form-row mt-3">
                    <div class="form-group col-sm-6">
                        <label for="address">Rua</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Digite o nome da sua rua" value="<?= ($profile_address['address'] ?? "") ?>" required>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="district">Bairro</label>
                        <input type="text" class="form-control" id="district" name="district" placeholder="Digite o nome do seu bairro" value="<?= ($profile_address['district'] ?? "") ?>" required>
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="number">Número</label>
                        <input type="number" class="form-control" id="number" name="number" placeholder="Digite o número da sua casa" value="<?= ($profile_address['number'] ?? "") ?>" required>
                    </div>
                </div>

                <div class="form-row mt-3">
                    <div class="form-group col-sm-3">
                        <label for="city">Cidade</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Digite o nome da sua cidade" value="<?= ($profile_address['city'] ?? "") ?>" required>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="state">Estado</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Digite o estado" value="<?= ($profile_address['state'] ?? "") ?>" required>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="complement">Complemento (Opcional)</label>
                        <input type="text" class="form-control" id="complement" name="complement" value="<?= ($profile_address['complement'] ?? "") ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>