<?php
session_start();
require 'config.php';

if(isset($_POST['tipo'])) {


    $tipo = $_POST['tipo'];
    $valor = str_replace(",", ".", $_POST['valor']);
    $valor = floatval($valor);

    $sql = $pdo->prepare("INSERT INTO historico (id_conta, tipo, valor, data_operacao) VALUES (:id_conta, :tipo, :valor, NOW())");
    $sql->bindValue(":id_conta", $_SESSION['banco']);
    $sql->bindValue(":tipo", $tipo);
    $sql->bindValue(":valor", $valor);
    $sql->execute();
    

    if($tipo == '0') {
        //Depósito
        $sql = $pdo->prepare("UPDATE contas SET saldo = saldo + :valor WHERE id = :id");
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":id", $_SESSION['banco']);
        $sql->execute();
        

       

    } else {
        // Saque

        $sql = $pdo->prepare("UPDATE contas SET saldo = saldo - :valor WHERE id = :id");
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":id", $_SESSION['banco']);
        $sql->execute();
    }

            
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco Diamond</title>
    <link rel="stylesheet" href="assets/css/saque.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
 <main>
    <img src="assets/images/banco.png" alt="">
    <div class="corpo">
        <form  method="POST" >

        <h3>Tipo de Transação</h3> 
            <br>
            <select name="tipo" id="" require>
                <option value="0">Depósito</option>
                <option value="1">Saque</option>
            
            </select> <br>

            <p> Digite o Valor </p>
            <input type="text" name="valor" pattern="[0-9,]{1,}" require/><br>
             
            <button type="submit">Executar</button>
        
        </form>

        

    </div>

    <a href="index.php" class="button">Inicio</a>
</main>   
    
</body>
</html>