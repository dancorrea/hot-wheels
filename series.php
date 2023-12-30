<?php
session_start();

require './config/connection.php';

if (!$_SESSION['log']) {
    header("Location: index.php");
}

$stmt = $pdo->prepare('SELECT * FROM serie ORDER BY colecao');
$stmt->execute();

require './pages/header.php';
?>

<div class="container">

    <a href="cadastro-serie.php" class="btn btn-outline-primary mt-5">
        <i class="bi bi-plus-circle"></i>  
        Adicionar Nova Série
    </a>

    <?php
    if ($stmt->rowCount() > 0) {
    ?>
        <div class="col-6 mb-5">
            <table class="table table-hover mt-4 mb-5">
                <thead>
                    <tr>
                        <th scope="col">Série</th>
                        <th scope="col">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($stmt->fetchAll() as $collection) {
                        echo "<tr>";
                        echo "<td>" . $collection['colecao'] . "</td>";
                        echo "<td>" . $collection['total'] . "</td>";
                        // echo "<td><a href='editar.php?cliente=" . $collection['id'] . "' class='btn btn-sm btn-secondary'>Editar</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        echo "<div class='text-center mt-5 p-2 bg-light border'>Sem coleções cadastradas.</div>";
    }
    ?>

</div>

<?php
require './pages/footer.php';
?>