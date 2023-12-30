<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex" />

    <title>Cadastro Hot Wheels</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0C5C99;">
        <div class="container-fluid">
            <a href="lista.php"><img src="images/hw-logo.jpg" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav" style="margin-left: 50px;">
                    <?php
                    if (isset($_SESSION['log']) || !empty($_SESSION['log'])) { ?>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="cadastro-hw.php" style="color: #FFF;">
                            <i class="bi bi-car-front-fill"></i>
                            &nbsp;&nbsp;Cadastrar Hot Wheels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="series.php" style="color: #FFF; padding-left: 35px;">
                            <i class="bi bi-collection-fill"></i>
                            &nbsp;&nbsp;Séries</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-item nav-link" style="position: fixed; right: 50px; color: #FFF;" href="sair.php">Sair</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>