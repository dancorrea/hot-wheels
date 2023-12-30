<?php

require './config/connection.php';

session_start();

$alert = "";

if (!$_SESSION['log']) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $colecao = filter_input(INPUT_POST, 'colecao', FILTER_SANITIZE_SPECIAL_CHARS);
    $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_SPECIAL_CHARS);

    $stmt = $pdo->prepare("INSERT INTO serie (colecao, total) VALUES (:colecao, :total)");
    $stmt->execute(array(
        ':colecao' => $colecao,
        ':total' => $total
    ));

    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "Nova coleção cadastrada.";
        $alert = "alert-success";
    } else {
        $_SESSION['message'] = "Erro ao cadastrar, confira os dados.";
        $alert = "alert-danger";
    }
}

require './pages/header.php';
?>

<div class="container">

    <h2 class="text-center mt-5">Cadastrar Nova Série</h2>

    <div class="m-5">
        <form action="cadastro-serie.php" method="post">

            <div class="mb-3">
                <input type="text" name="colecao" class="form-control" placeholder="Nome da coleção" required>
            </div>
            <div class="mb-3">
                <input type="number" name="total" class="form-control" placeholder="Quantidade total da série">
            </div>            
            <button type="submit" class="btn btn-primary">Cadastrar</button><br />

        </form>

        <br/>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert " . $alert . "' role='alert'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
            sleep(2);
            header("Location: series.php");
        }
        ?>
    </div>

</div>

<?php
require './pages/footer.php';
?>