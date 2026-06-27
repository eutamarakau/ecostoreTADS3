<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    $idUsuario    = $_SESSION['idUsuario'];
    $nomeUsuario  = $_SESSION['nomeUsuario'];
    $emailUsuario = $_SESSION['emailUsuario'];
    $nivelUsuario = $_SESSION['nivelUsuario'];

    $nomeCompleto = explode(' ', $nomeUsuario);
    $primeiroNome = $nomeCompleto[0];
}

date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EcoStore</title>

    <link rel="icon" type="image/x-icon" href="assets/img/ecoLogo.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<!-- HEADER -->
<header class="py-4">
    <div class="container text-center text-white">

        <div class="d-flex justify-content-center align-items-center mb-2">
            <img src="assets/img/ecoLogo.png"
                 alt="EcoStore"
                 width="80"
                 class="me-3">

            <h1 class="fw-bold mb-0">EcoStore</h1>
        </div>

        <p class="lead mb-0">
            Produtos Sustentáveis, Naturais e Amigáveis ao Planeta
        </p>

    </div>
</header>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container px-4 px-lg-5">

        <a class="navbar-brand fw-bold" href="index.php">EcoStore</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Página Inicial</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre nós</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="suporte.php">Suporte</a>
                </li>
            </ul>

            <ul class="navbar-nav">

                <?php
                if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {

                    if ($nivelUsuario == 'administrador') {
                ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               id="navbarDropdown"
                               role="button"
                               data-bs-toggle="dropdown">

                                <i class="bi bi-person-circle"></i>
                                <?= $primeiroNome ?>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="formProduto.php">Novo Produto</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="gerenciarPedidos.php">Gerenciar Pedidos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                            </ul>
                        </li>

                <?php
                    } else {
                ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               id="navbarDropdown"
                               role="button"
                               data-bs-toggle="dropdown">

                                <i class="bi bi-person-circle"></i>
                                <?= $primeiroNome ?>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="minhasCompras.php">Minhas Compras</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                            </ul>
                        </li>

                <?php
                    }
                } else {
                ?>

                    <li class="nav-item">
                        <a class="btn btn-success" href="formLogin.php">
                            Login
                        </a>
                    </li>

                <?php } ?>
<!-- Scripts Bootstrap 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>-->
            </ul>

        </div>
    </div>
</nav>