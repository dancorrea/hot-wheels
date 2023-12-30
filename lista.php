<?php
session_start();

require './config/connection.php';

if (!$_SESSION['log']) {
    header("Location: index.php");
}

$stmt = $pdo->prepare('SELECT * FROM clientes');
$stmt->execute();

require './pages/header.php';
?>

<div class="container">

    <!-- <h2 class="text-center mt-5">Coleção</h2> -->

    <?php

    if ($stmt->rowCount() > 0) {
    ?>
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Data</th>
                    <th scope="col">Funções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stmt->fetchAll() as $client) {
                    echo "<tr>";
                    echo "<td>" . $client['name'] . "</td>";
                    echo "<td>" . $client['cpf'] . "</td>";
                    echo "<td>" . $client['tel'] . "</td>";
                    echo "<td>" . $client['email'] . "</td>";
                    echo "<td>" . date('d/m/y', strtotime($client['date'])) . "</td>";
                    echo "<td><a href='editar.php?cliente=" . $client['id'] . "' class='btn btn-sm btn-secondary'>Editar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    <?php
    } else {
        echo "<div class='text-center mt-5 p-2 bg-light border'>Nenhum Hot Wheels cadastrado.</div>";
    }
    ?>

</div>

<?php
require './pages/footer.php';
?>