<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="row bg-warning">
        <div class="col-md-12">
            <div class="text-center p-4">
                <h1><?= $product['nameProduct'] ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 mt-5">
                <a href="<?= url('home'); ?>">Home</a>
                <span>/</span>
                <a href="#" class="text-dark"><?= $product['nameProduct'] ?></a>
            </div>

            <div class="row">
                <div class="col-sm-6 mb-5">
                    <div id="carouselPhotos" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="<?= self::loadImg("/fotos/" . $product['mainPhoto']); ?>" alt="First slide">
                            </div>
                            <?php foreach ($photos as $photos) : ?>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="<?= self::loadImg("/fotos/" . $photos['namePhoto']); ?>" alt="First slide">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselPhotos" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselPhotos" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="product-inner">
                        <h1><?= $product['nameProduct'] ?></h1>
                        <div class="mt-3">
                            <p class="font-weight-bold h5 text-success">R$ <?= format_price($product['price']) ?></p>
                        </div>

                        <form action="<?= url('add.cart', ['id' => $product['idProduct']]); ?>" method="POST">
                            <div class="form-inline">
                                <?= csrf_token(); ?>
                                <input type="hidden" name="idProduct" value="<?= $product['idProduct']; ?>">
                                <input type="number" size="4" class="form-control col-2" title="Qty" value="1" name="qtd" min="1" step="1">
                                <button class="btn btn-warning ml-2" type="submit">
                                    <i class="fas fa-shopping-cart"></i> Adicionar ao carrinho
                                </button>
                            </div>
                        </form>

                        <div class="mt-4">
                            <p>Categoria:
                                <a href="#"><?= $product['nameCategory']; ?></a>
                            </p>
                        </div>

                        <div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descrição do Produto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="profile" aria-selected="false">Reviews</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contato" role="tab" aria-controls="contact" aria-selected="false">Avaliar</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <p class="mt-3"><?= $product['description']; ?></p>
                                </div>
                                <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="profile-tab">...
                                </div>
                                <div class="tab-pane fade" id="contato" role="tabpanel" aria-labelledby="contact-tab">
                                    <form class="mt-3">
                                        <p class="form-inline">
                                            <label for="name">Name</label>
                                            <input name="name" type="text" class="form-control w-75 ml-2">
                                        </p>

                                        <p class="form-inline">
                                            <label for="email">Email</label>
                                            <input name="email" type="email" class="form-control w-75 ml-2">
                                        </p>

                                        <div class="rating-chooser">
                                            <p>Your rating</p>

                                            <div class="rating-wrap-post">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>

                                        <p class="mt-4">
                                            <label for="review">Fazer um comentário</label>
                                            <textarea name="review" id="" cols="60" rows="10" class="form-control w-75 ml-2"></textarea>
                                        </p>
                                        <p>
                                            <button type="submit" class="btn btn-warning">Comentar</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>