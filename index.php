<?php
session_start();

if (isset($_SESSION['log']) || !empty($_SESSION['log'])) {
    header("Location: lista.php");
}

if (!empty($_POST)) {
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    if (password_verify('#Digital6', $pass)) {
        $_SESSION['log'] = true;
        header("Location: lista.php");
    } else {
        $_SESSION['message'] = "Dados inválidos.";
    }
}

require './pages/header.php';
?>

<div class="container text-center">

    <h2 class="mt-5">Sistema Hot Wheels</h2>

    <div class="d-flex justify-content-center m-5">
        <form action="index.php" method="POST">

            <div class="mb-3">
                <input type="password" name="pass" class="form-control" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>

        </form>
    </div>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>

</div>

<?php
require './pages/footer.php';
?>