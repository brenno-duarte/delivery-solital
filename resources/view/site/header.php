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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-dark" href="<?= url('home'); ?>">Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {% include 'site/category-menu.html' %}
                        </div>
                    </li>
                </ul>
            </div>
            <!-- <a class="nav-link text-dark mini-menu" href="?= url('cart'); ?>">
                <i class="fas fa-shopping-cart" style="font-size: 30px;"></i>
                <span class="txt-r">
                    Carrinho
                </span>
            </a> -->
        </div>
    </nav>

    <section>