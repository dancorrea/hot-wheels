<?php

require './config/connection.php';

session_start();

$alert = "";

if (!$_SESSION['log']) {
    header("Location: index.php");
}

$stmt_serie = $pdo->prepare('SELECT * FROM serie ORDER BY colecao');
$stmt_serie->execute();

if (!empty($_POST)) {

    $colecao = filter_input(INPUT_POST, 'colecao', FILTER_SANITIZE_SPECIAL_CHARS);
    $marca = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_SPECIAL_CHARS);
    $modelo = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_SPECIAL_CHARS);
    $ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_SPECIAL_CHARS);
    $cor = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);

    $stmt = $pdo->prepare("
        INSERT INTO item (colecao, marca, modelo, ano, cor, numero) 
        VALUES (:colecao, :marca, :modelo, :ano, :cor, :numero)
    ");

    $stmt->execute(array(
        ':colecao' => $colecao,
        ':marca' => $marca,
        ':modelo' => $modelo,
        ':ano' => $ano,
        ':cor' => $cor,
        ':numero' => $numero
    ));

    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "Novo item cadastrado
        .";
        $alert = "alert-success";
        unset($_SESSION['message']);
        sleep(2);
        header("Location: lista.php");
    } else {
        $_SESSION['message'] = "Erro ao cadastrar, confira os dados.";
        unset($_SESSION['message']);
        $alert = "alert-danger";
    }
}

require './pages/header.php';
?>

<div class="container">

    <h2 class="text-center mt-5">Cadastrar Novo Hot Wheels</h2>

    <div class="m-5">
        <form action="cadastro-hw.php" method="post">

            <div class="mb-3">
            <select name="colecao" class="form-select" required>
                <option selected>Escolha uma coleção</option>
                <?php      
                if ($stmt_serie->rowCount() > 0) {
                    foreach ($stmt_serie->fetchAll() as $serie) {
                        echo "<option value='" . $serie['id'] . "'>" . $serie['colecao'] . "</option>";
                    }
                }
                ?>
            </select>
            </div>
            <div class="mb-3">
                <input type="text" name="marca" class="form-control" placeholder="Fabricante" required>
            </div>
            <div class="mb-3">
                <input type="text" name="modelo" class="form-control" placeholder="Modelo" required>
            </div>
            <div class="mb-3">
                <input type="text" name="ano" class="form-control" placeholder="Ano">
            </div>
            <div class="mb-3">
                <input type="text" name="cor" class="form-control" placeholder="Cor">
            </div>
            <div class="mb-3">
                <input type="text" name="numero" class="form-control" placeholder="Número na coleção">
            </div>           
            <button type="submit" class="btn btn-primary">Cadastrar</button><br />

        </form>

        <br/>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert " . $alert . "' role='alert'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
            sleep(2);
            header("Location: lista.php");
        }
        ?>
    </div>

</div>

<?php
require './pages/footer.php';
?>