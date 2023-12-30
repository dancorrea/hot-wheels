<?php
session_start();

require './config/connection.php';

if (!$_SESSION['log']) {
    header("Location: index.php");
}

$stmt = $pdo->prepare('
    SELECT s.colecao, i.marca, i.modelo, i.ano, i.cor, i.numero  
    FROM item AS i 
    INNER JOIN serie as s 
    ON i.colecao = s.id
    ORDER BY i.marca, i.modelo;
');
$stmt->execute();

require './pages/header.php';
?>

<div class="container">

    <!-- <h2 class="text-center mt-5">Coleção</h2> -->

    <?php

    if ($stmt->rowCount() > 0) {
    ?>
        <div class="col-12 mb-5">
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">Coleção</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Cor</th>
                        <th scope="col">Número</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($stmt->fetchAll() as $item) {
                        echo "<tr>";
                        echo "<td>" . $item['colecao'] . "</td>";
                        echo "<td>" . $item['marca'] . "</td>";
                        echo "<td>" . $item['modelo'] . "</td>";
                        echo "<td>" . $item['ano'] . "</td>";
                        echo "<td>" . $item['cor'] . "</td>";
                        echo "<td>" . $item['numero'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    <?php
    } else {
        echo "<div class='text-center mt-5 p-2 bg-light border'>Nenhum Hot Wheels cadastrado.</div>";
    }
    ?>

</div>

<?php
require './pages/footer.php';
?>