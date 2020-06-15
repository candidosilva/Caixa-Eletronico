<?php
session_start();
require 'config.php';

if(isset($_SESSION['banco']) && !empty($_SESSION['banco'])) {
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/historico.css">

</head>
<body>
<header>
        <div class="bem-vindo">
            Bem Vindo <br>
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
    <div class="historico">
    <table>
        <tr>
            <th>Data</th>
            <th>Valor</th>
        
        </tr>
        <?php
            $sql = $pdo->prepare("SELECT * FROM historico WHERE id_conta = :id_conta");
            $sql->bindValue(":id_conta", $id);
            $sql->execute();

            if($sql->rowCount() > 0 ) {
                foreach($sql->fetchAll() as $item) {
                    ?>
                    <tr>
                        <td><?php echo date('d/m/Y H:i', strtotime($item['data_operacao'])); ?></td>
                        <td>
                        <?php if($item['tipo'] == '0'): ?>
                            <font color="green">   +  R$ <?php echo $item['valor'] ?></font>
                        <?php else: ?>
                        <font color="red">   -  R$ <?php echo $item['valor'] ?></font>
                        <?php endif; ?>                        
                        </td>                            
                    </tr>
                            <?php
                }
            }
                            ?>
    </table>
    </div>
    </main>

    <footer>
        <div class="conta">
            <p>Conta: <?php echo $info['conta']; ?></p>
            <p>Agência: <?php echo $info['agencia']; ?></p>
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