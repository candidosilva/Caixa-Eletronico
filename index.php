<?php
session_start();
require 'config.php';

if(isset($_SESSION['banco']) && empty($_SESSION['banco']) == false ) {
    $id = $_SESSION['banco'];

    $sql = $pdo->prepare("SELECT * FROM contas WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0 ) {
        $info = $sql->fetch();
    } else {
        header("Location: login.php");
        exit;
    }

} else {
    header("Location: login.php");
        exit;
}

?>



<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco Diamond</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <div class="bem-vindo">
            Bem Vindo: <br>
            <?php echo $info['titular']; ?>
        </div>
        <div class="img">
            <img src="assets/images/logo.png" alt="logo">
        </div>

        <div class="suport">
            <p> Suporte ao Cliente </p>
            <p>(99) 1234-4321</p>
        </div>
    </header>
    <main>
        <div class="corpo">
            <div class="text">
                Go Diamond
            </div>
            <div class="infobox">
                <div class="saldo">
                   <h1>Saldo</h1> 
                   <p>R$
                   <?php echo $info['saldo']; ?>
                    </p>
                </div>
                <div class="saque-deposito">
                <a href="saque-deposito.php">
                    <div class="saque">
                        <h1>Saque</h1>
                        <img src="assets/images/arrow.png" alt="">
                        <h1>Depósito</h1>
                    </div>
                </a>
                <a href="historico.php">
                    <div class="deposito">
                    <h1>Histórico</h1>
                        <img src="assets/images/arrow.png" alt="">
                    </div>
                </a>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="conta">
            <p>Conta:<?php echo $info['conta']; ?></p>
            <p>Agência:<?php echo $info['agencia']; ?></p>
        </div>

        <div class="data">
            <?php date_default_timezone_set('UTC');
            echo date("d/m/Y");  ?> <br>
        </div>

        <div class="sair">
            <a href="sair.php">Sair</a>
        </div>
    </footer>
</body>
</html>