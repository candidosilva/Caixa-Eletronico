<?php
require 'config.php';

$titular = filter_input(INPUT_POST, 'titular');
$agencia = filter_input(INPUT_POST, 'agencia');
$conta = filter_input(INPUT_POST, 'conta');
$senha = filter_input(INPUT_POST, 'senha');

if(isset($_POST['titular']) && !empty($_POST['titular'])) {


    $sql = $pdo->prepare("SELECT * FROM contas WHERE agencia = :agencia AND conta = :conta");
    $sql->bindValue(':agencia', $agencia);
    $sql->bindValue(':conta', $conta);
    $sql->execute();


    if($sql->rowCount() === 0) {

        echo("row entrou");
        $sql = $pdo->prepare("INSERT INTO contas (titular, agencia, conta, senha) VALUES (:titular, :agencia, :conta, :senha) ");
        $sql->bindValue(':titular', $titular);
        $sql->bindValue(':agencia', $agencia);
        $sql->bindValue(':conta', $conta);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        header("Location: index.php");
        exit;

    } else {
        header("Location: login.php");
        exit;
    }
    
} 




?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco Diamond</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
 <main>
    <img src="assets/images/banco.png" alt="">
    <div class="corpo">
        <form method="POST" >
            <h1>ACESSAR SUA CONTA</h1>  

            <p>Titular</p>
            <input type="text" name="titular" placeholder="Nome" require> <br>
            <p>Agência</p>
            <input type="number" name="agencia"   require>
             <br> 
             <p>Conta</p>
            <input type="number" name="conta"   require>
            <br> 
             <p>Senha</p> 
            <input type="number" name="senha"   require >

            <button type="submit">CADASTRAR</button>
        
        </form>
    </div>
</main>   
    
</body>
</html>