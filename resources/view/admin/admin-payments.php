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
            <form class="form-signin mt-3" method="POST" action="<?= url('payments.post', ['id' => $informations['idSet']]); ?>" enctype="multipart/form-data">
                <?= csrf_token(); ?>

                <!-- INSERIR CÓDIGOS AQUI -->
                
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