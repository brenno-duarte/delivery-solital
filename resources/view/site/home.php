<?php include('header.php'); ?>

<!-- <div class="mt-5 mb-3 container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Categorias</h2>
            <div>
                <div style="background-color: darkblue; width: 18em;">
                    <h4>1</h4>
                </div>
                <div style="background-color: darkblue; width: 18em;">
                    <h4>2</h4>
                </div>
                <div style="background-color: darkblue; width: 18em;">
                    <h4>3</h4>
                </div>
                <div style="background-color: darkblue; width: 18em;">
                    <h4>4</h4>
                </div>
                <div style="background-color: darkblue; width: 18em;">
                    <h4>5</h4>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Produtos</h2>
                <div class="form-inline d-flex justify-content-center">
                    <?php if ($products) : ?>
                        <?php foreach ($products as $prod) : ?>
                            <div class="bg-light p-3 border ml-2 mt-3">
                                <img src="<?= self::loadImg("fotos/" . $prod['mainPhoto']); ?>" class="img-fluid mb-5" style="width: 220px; height: 220px;">
                                <!-- <div class="mt-3">
                                    <form action="<?= url('add.cart', ['id' => $prod['idProduct']]); ?>" method="POST">
                                        <div class="form-inline">
                                            <?= csrf_token(); ?>
                                            <input type="hidden" name="idProduct" value="<?= $prod['idProduct']; ?>">
                                            <input type="hidden" size="4" class="form-control col-md-2" title="Qty" value="1" name="qtd" min="1" step="1">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-shopping-cart"></i>
                                                Adicionar ao carrinho
                                            </button>
                                        </div>
                                    </form>
                                </div> -->

                                <p class="mt-2">
                                    <a href="<?= url('product.detail', ['id' => $prod['idProduct'], 'name' => strtolower(str_replace(" ", "_", $prod['nameProduct']))]); ?>" class="text-dark"><?= $prod['nameProduct']; ?></a>
                                </p>
                                <div>
                                    <p class="h5 font-weight-bold">R$ <?= format_price($prod['price']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Não existem produtos cadastrados</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-5 d-flex justify-content-center">
                <?= $arrows; ?>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>