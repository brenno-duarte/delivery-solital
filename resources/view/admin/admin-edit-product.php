<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="p-4 display-4"><?= $title; ?></h1>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-signin mt-3" method="POST"
                action="<?= url('edit.product.post', ['id' => $product['idProduct']]); ?>" enctype="multipart/form-data">
                <?= csrf_token(); ?>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">Nome do produto</label>
                        <input type="text" id="name" class="input-class" name="name"
                            value="<?= $product['nameProduct']; ?>" required autofocus>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="price">Preço</label>
                        <input type="number" id="price" class="input-class" name="price"
                            value="<?= $product['price']; ?>" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="stock">Estoque</label>
                        <input type="number" id="stock" class="input-class" name="stock"
                            value="<?= $product['stock']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" cols="10" rows="5" class="input-class"
                            required><?= $product['description']; ?></textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="photo">Foto</label>
                        <input type="file" id="photo" class="input-class" name="photo[]" multiple required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="category">Categoria</label>
                        <select id="category" class="select-class" name="category" required>
                            <option value="<?= $product['idCategory']; ?>"><?= $product['nameCategory']; ?> (Cadastrado)
                            </option>
                            <?php foreach($allcategory as $c): ?>
                            <option value="<?= $c['idCategory']; ?>"><?= $c['nameCategory']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="img-fluid" src="<?= self::loadImg("/fotos/".$first_photo['namePhoto']); ?>">
                            </div>
                            <?php foreach($photos as $p): ?>
                                <div class="carousel-item">
                                    <img class="img-fluid" src="<?= self::loadImg("/fotos/".$p['namePhoto']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carousel" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
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