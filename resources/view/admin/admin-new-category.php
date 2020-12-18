<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="p-4 display-4"><?= $title; ?></h1>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-signin mt-3" method="POST" action="<?= url('newCategoryPost'); ?>">
                <?= csrf_token() ?>
                <div class="form-group">
                    <label for="name">Nome da categoria</label>
                    <input type="text" id="name" class="input-class" name="name" required autofocus>
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