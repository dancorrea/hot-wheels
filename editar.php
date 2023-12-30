<?php

require './config/connection.php';

session_start();

if (!$_SESSION['log']) {
    header("Location: index.php");
}

if (!empty($_GET['cliente'])) {

    $id = filter_input(INPUT_GET, 'cliente', FILTER_VALIDATE_INT);

    $stmt = $pdo->prepare('SELECT * FROM clientes WHERE id = :id');
    $stmt->execute(array(
        ':id' => $id
    ));

    if ($stmt->rowCount() > 0) {
        $client = $stmt->fetch();
    } else {
        $_SESSION['message'] = "Cliente inexistente.";
        echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['message'] . "</div>";
        header("Location: lista.php");
    }
}

if (!empty($_POST)) {

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    $stmt = $pdo->prepare("UPDATE clientes SET name = :name, cpf = :cpf, tel = :tel, email = :email WHERE id = :id");
    $stmt->execute(array(
        ':name' => $name,
        ':cpf' => $cpf,
        ':tel' => $tel,
        ':email' => $email,
        ':id' => $id
    ));

    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "Cadastro atualizado com sucesso.";
        header("Location: lista.php");
    } else {
        $_SESSION['message'] = "Erro ao atualizar, confira os dados.";
    }
}

require './pages/header.php';
?>

<div class="container">

    <h2 class="text-center mt-5">Editar Cadastro</h2>

    <div class="m-5">
        <form action="editar.php" method="post">

            <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Nome Completo" value="<?php echo $client['name']; ?>" required>
            </div>
            <div class="mb-3">
                <input type="text" name="cpf" class="form-control" placeholder="CPF (apenas números)" value="<?php echo $client['cpf']; ?>">
            </div>
            <div class="mb-3">
                <input type="text" name="tel" class="form-control" placeholder="Telefone" value="<?php echo $client['tel']; ?>">
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $client['email']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button><br />

            <?php
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-anger' role='alert'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
                sleep(2);
                header("Location: lista.php");
            }
            ?>
        </form>
    </div>

</div>

<?php
require './pages/footer.php';
?>