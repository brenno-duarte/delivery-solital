<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= self::loadCss('reset.css'); ?>">
    <link rel="stylesheet" href="<?= self::loadCss('bootstrap.css'); ?>">

    <!-- Font Awesome -->
    <link href="<?= self::loadFile('assets/fonts/fontawesome/css/fontawesome-all.min.css'); ?>" type="text/css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= self::loadCss('style.css'); ?>" />
    <link rel="stylesheet" href="<?= self::loadCss('responsive.css'); ?>" />
    <link rel="stylesheet" href="<?= self::loadCss('pagination.css'); ?>" />

    <!-- Icon -->
    <link rel="icon" href="<?= self::loadImg('favicon.ico'); ?>">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-warning">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= url('home'); ?>">Início <span class="sr-only">(página atual)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link txt-5 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #000 !important;">
                            Categorias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($categories as $cat) : ?>
                                <a class="dropdown-item" href="/categories/$cat['idCategory']"><?= $cat['nameCategory'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <!-- <form>
                        <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                    </form> -->

                    <?php if (Solital\Core\Resource\Session::has('solital_index_profile')) : ?>
                        <a href="<?= url('profile') ?>" class="btn btn-primary">Acessar conta</a>
                    <?php else : ?>
                        <a href="<?= url('profile.login') ?>" class="btn btn-primary">Fazer Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <section>