<?php

use Solital\Core\Resource\Session;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php if ($_SERVER['REQUEST_URI'] == "/admin/order" || $_SERVER['REQUEST_URI'] == "/admin/send-order" || $_SERVER['REQUEST_URI'] == "/admin/dashboard") : ?>
        <meta http-equiv="refresh" content="15" />
    <?php endif ?>
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= self::loadCss('reset.css'); ?>">
    <link rel="stylesheet" href="<?= self::loadCss('bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?= self::loadCss('sidebar.css'); ?>">
    <link rel="stylesheet" href="<?= self::loadCss('theme-1.css'); ?>">
    <link rel="stylesheet" href="<?= self::loadCss('custom.css'); ?>">
    <link rel="stylesheet" href="<?= self::loadCss('pagination.css'); ?>">
    <link rel="icon" href="<?= self::loadImg('favicon.ico'); ?>">
    <!-- Font awesome 5 -->
    <link href="<?= self::loadFile('assets/fonts/fontawesome/css/fontawesome-all.min.css'); ?>" type="text/css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-right bg-menu shadow no-border" id="sidebar-wrapper">
            <div class="sidebar-heading shadow welcome mb-4">
                <span class="navbar-brand" href="#">
                    <p class="txt-5 font-weight-bold">
                        <i class="fas fa-door-open"></i>
                        Bem vindo
                    </p>
                    <small class="txt-5"><?= "Data: " . date('d/m/Y') ?></small>
                </span>
            </div>
            <div class="scroll-1">
                <ul class="list-group list-group-flush bg-menu">
                    <a href="<?= url('dashboard'); ?>" class="list-group-item list-group-item-action no-border bg-menu">
                        <i class="fas fa-home"></i> Dashboard
                    </a>

                    <a class="list-group-item list-group-item-action no-border bg-menu" href="#cadastrar" data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-user-plus"></i>
                        Cadastrar
                        <i class="fas fa-arrows-alt-v"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="cadastrar">
                        <a href="<?= url('product'); ?>" class="subitem">
                            <li class="p-3">Produto</li>
                        </a>

                        <a href="<?= url('category'); ?>" class="subitem">
                            <li class="p-3">Categoria</li>
                        </a>
                    </ul>

                    <a href="<?= url('order'); ?>" class="list-group-item list-group-item-action no-border bg-menu">
                        <i class="far fa-address-book"></i> Pedidos
                    </a>

                    <a href="<?= url('report'); ?>" class="list-group-item list-group-item-action no-border bg-menu">
                        <i class="fas fa-chart-bar"></i> Relatório
                    </a>

                    <a href="<?= url('setting') ?>" class="list-group-item list-group-item-action no-border bg-menu">
                        <i class="fas fa-cog"></i> Configurações
                    </a>
                    
                    <a href="about.php" class="list-group-item list-group-item-action no-border bg-menu">
                        <i class="fas fa-address-card"></i> About
                    </a>
                </ul>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-5 w-100 bg-menu-2 shadow-sm">
                <button class="btn btn-theme" id="menu-toggle">
                    <i class="fas fa-arrows-alt-h p-1 "></i>
                </button>

                <button class="navbar-toggler navbar-icon bg-8" type="button" data-toggle="collapse" data-target="#navbar-menu-2" aria-controls="navbar-menu-2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-menu-2">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item mr-3">
                            <a class="nav-link home-link" target="_blank" href="<?= url('home'); ?>">
                                <i class="fas fa-home"></i>
                                Ver site
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown username" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <span id="username" class="username">
                                    <i class="fa fa-user username"></i>
                                    <?= Session::show('solital_index_login'); ?>
                                </span>
                            </a>
                            <div class="dropdown-menu bg-menu mt-2 no-border">
                                <div class="text-center font-weight-bold dropdown-name">
                                    Olá, <?= Session::show('solital_index_login'); ?> <span for="nameCookie"></span>
                                </div>
                                <a class="dropdown-item" href="#">Meu perfil</a>
                                <a class="dropdown-item" href="#">Sair</a>
                            </div>
                        </li>
                        <a class="nav-link dropdown btn btn-4" href="<?= url('exit'); ?>" role="button">
                            <i class="fas fa-sign-out-alt"></i>
                            Sair
                        </a>
                    </ul>
                </div>
            </nav>

            <section class="container-fluid">