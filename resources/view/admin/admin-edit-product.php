<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="p-4 display-4"><?= $title; ?></h1>
    </div>
</div>

<?php if ($msg1) : ?>
    <div class="txt-3 text-center font-2 mb-3 mt-4 col-md-12">
        <i class="fas fa-check-circle"></i>
        <?= $msg1; ?>
    </div>
<?php endif; ?>

<section class="content mb-5">
    <div class="row">
        <div class="col-md-12">
            <form class="form-signin mt-3" method="POST" action="<?= url('edit.product.post', ['id' => $product['idProduct']]); ?>" enctype="multipart/form-data">
                <?= csrf_token(); ?>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">Nome do produto</label>
                        <input type="text" id="name" class="input-class" name="name" value="<?= $product['nameProduct']; ?>" required autofocus>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="price">Preço</label>
                        <input type="number" id="price" class="input-class" name="price" value="<?= $product['price']; ?>" step="0.01" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="stock">Estoque</label>
                        <input type="number" id="stock" class="input-class" name="stock" value="<?= $product['stock']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" cols="10" rows="5" class="input-class" required><?= $product['description']; ?></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="category">Categoria</label>
                        <select id="category" class="select-class" name="category" required>
                            <option value="<?= $product['idCategory']; ?>"><?= $product['nameCategory']; ?> (Cadastrado)
                            </option>
                            <?php foreach ($allcategory as $c) : ?>
                                <option value="<?= $c['idCategory']; ?>"><?= $c['nameCategory']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <fieldset class="border border-secondary p-2 mb-5" style="border-radius: 10px;">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="weight">Peso (kg)</label>
                            <input type="number" step="0.01" id="weight" class="input-class" name="weight" value="<?= $product['weight']; ?>" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="width">Largura (cm)</label>
                            <input type="number" step="0.01" id="width" class="input-class" name="width" value="<?= $product['width']; ?>" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="length">Comprimento (cm)</label>
                            <input type="number" step="0.01" id="length" class="input-class" name="length" value="<?= $product['length']; ?>" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="height">Altura (cm)</label>
                            <input type="number" step="0.01" id="height" class="input-class" name="height" value="<?= $product['height']; ?>" required>
                        </div>
                    </div>
                </fieldset>

                <div class="row">
                    <div class="col-sm-4">
                        <fieldset>
                            <legend>Foto principal</legend>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card text-center">
                                        <img class="card-img-top img-thumbnail" src="<?= self::loadImg("/fotos/" . $product['mainPhoto']); ?>">
                                        <div class="card-body mx-auto">
                                            <p>Alterar foto principal</p>
                                            <input type="file" id="mainPhoto" class="input-class" name="mainPhoto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-sm-8">
                        <fieldset>
                            <legend>Outras fotos</legend>
                            <div class="row">
                                <div class="bg-white">
                                    <?php foreach ($photos as $p) : ?>
                                        <div class="card mt-3 mb-3 text-center mx-auto col-12 col-md-6 col-lg-3">
                                            <img class="card-img-top img-thumbnail" src="<?= self::loadImg("/fotos/" . $p['namePhoto']); ?>">
                                            <div class="card-body">
                                                <a onclick="return confirm('Deseja realmente excluir esta foto?')" href="<?= url('delete.photo', ['id' => $p['idPhoto'], 'idProduct' => $product['idProduct']]) ?>" class="btn btn-4">
                                                    <i class="fas fa-trash-alt"></i> Excluir foto
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <p>Adicionar mais fotos</p>
                                            <input type="file" id="othersPhotos" class="input-class" name="othersPhotos[]" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
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