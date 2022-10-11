<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="p-4 display-4"><?= $title; ?></h1>
    </div>
</div>

<section class="content">

    <?php if ($msg1) : ?>
        <div class="txt-3 text-center font-2 mb-3 mt-4 col-md-12">
            <i class="fas fa-check-circle"></i>
            <?= $msg1; ?>
        </div>
    <?php endif; ?>

    <?php if ($msg2) : ?>
        <div class="txt-3 text-center font-2 mb-3 mt-4 col-md-12">
            <i class="fas fa-check-circle"></i>
            <?= $msg2; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <form class="form-signin mt-3" method="POST" action="<?= url('informations.post', ['id' => $informations['idSet']]); ?>" enctype="multipart/form-data">
                <?= csrf_token(); ?>

                <h2 class="mb-4">Informações da empresa</h2>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company">Nome da empresa</label>
                        <input type="text" name="company" id="company" class="input-class" value="<?= $informations['companyName'] ?>" required autofocus>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="phone">Telefone</label>
                        <input type="tel" name="phone" id="phone" class="input-class" value="<?= $informations['phone'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email">E-mail (Opcional)</label>
                        <input type="email" name="email" id="email" class="input-class" value="<?= $informations['email'] ?>" required>
                    </div>
                </div>

                <h2 class="mb-4 mt-4">Endereço da empresa</h2>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="address">Rua</label>
                        <input type="text" id="address" class="input-class" name="address" value="<?= $informations['address'] ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="district">Bairro</label>
                        <input type="text" id="district" class="input-class" name="district" value="<?= $informations['district'] ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="state">Estado</label>
                        <select id="state" name="state" class="select-class" required>
                            <option value="<?= $informations['state'] ?>" selected><?= $informations['state'] ?> (Cadastrado)</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="number">Número</label>
                        <input type="number" id="number" class="input-class" name="number" value="<?= $informations['number'] ?>" required>
                    </div>
                </div>

                <h2 class="mb-4 mt-4">Logomarca</h2>
                <div class="form-row">
                    <?php if ($informations['logo'] != null) : ?>
                        <div class="form-group col-md-6 rounded border border-secondary p-3">
                            <img src="<?= self::loadImg($informations['logo']) ?>" class="img-fluid">
                            <a onclick="return confirm('Deseja realmente excluir esta foto?')" href="<?= url('delete.logo', ['id' => $informations['idSet']]) ?>" class="btn btn-4 float-right" onclick="return confirm('Apagar a logomarca atual?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="form-group col-md-6">
                        <input type="file" name="logo" id="logo" class="input-class">
                    </div>
                </div>

                <div class="mt-5 mb-5 d-flex justify-content-center form-inline">
                    <button class="btn btn-3 mr-3" type="submit">
                        <i class="fas fa-check-circle"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>