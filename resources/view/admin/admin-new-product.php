<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="p-4 display-4"><?= $title; ?></h1>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-signin mt-3" method="POST" action="<?= url('new.product.post'); ?>" enctype="multipart/form-data">
                <?= csrf_token(); ?>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">Nome do produto</label>
                        <input type="text" id="name" class="input-class" name="name" required autofocus>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="price">Preço</label>
                        <input type="number" id="price" class="input-class" name="price" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="stock">Estoque</label>
                        <input type="number" id="stock" class="input-class" name="stock" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" cols="7" rows="5" class="input-class" required></textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="mainPhoto">Foto Principal</label>
                        <input type="file" id="mainPhoto" class="input-class" name="mainPhoto" required>

                        <label for="photo">Foto</label>
                        <input type="file" id="photo" class="input-class" name="photo[]" multiple required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="category">Categoria</label>
                        <select id="category" class="select-class" name="category" required>
                            <option value="" selected disabled>Selecione a categoria</option>
                            <?php foreach($categories as $c): ?>
                            <option value="<?= $c['idCategory']; ?>"><?= $c['nameCategory']; ?></option>
                            <?php endforeach; ?>
                        </select>
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