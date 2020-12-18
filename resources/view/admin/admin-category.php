<?php include('header.php'); ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="p-4 display-4"><?= $title; ?></h1>
    </div>
</div>

<section class="content">
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="<?= url('newCategory'); ?>" class="btn btn-3">
                <i class="fas fa-plus-circle"></i> Nova Categoria
            </a>
        </div>

        <div class="col-md-6 d-flex justify-content-end">
            <form action="#" method="get">
                <input type="text" placeholder="&#xf002; Search..." class="input-search">
            </form>
        </div>
    </div>

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

    <?php if ($msg3) : ?>
        <div class="txt-3 text-center font-2 mb-3 mt-4 col-md-12">
            <i class="fas fa-check-circle"></i>
            <?= $msg3; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-action">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($rows) : ?>
                        <?php foreach ($rows as $cat) : ?>
                            <tr>
                                <td><?= $cat['idCategory'] ?></td>
                                <td><?= $cat['nameCategory'] ?></td>
                                <td>
                                    <a href="<?= url('editCategory', ['id' => $cat['idCategory']]); ?>" class="btn btn-2 mr-3">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <a href="<?= url('deleteCategory', ['id' => $cat['idCategory']]); ?>" class="btn btn-4" onclick="return confirm('Deseja realmente excluir esta categoria?')">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td><span>Não foram encontrado resultados</span></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-5 d-flex justify-content-center">
            <?= $arrows; ?>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>