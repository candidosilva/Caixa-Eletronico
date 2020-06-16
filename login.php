<?php
session_start();
require 'config.php';

if(isset($_POST['agencia'])  && empty($_POST['agencia']) == false) {

    $agencia = addslashes($_POST['agencia']);
    $conta = addslashes($_POST['conta']);
    $senha = addslashes($_POST['senha']);

    $sql = $pdo->prepare("SELECT * FROM contas WHERE agencia = :agencia AND conta = :conta AND senha = :senha");
    $sql->bindValue(":agencia", $agencia);
    $sql->bindValue(":conta", $conta);
    $sql->bindValue(":senha", md5($senha));
    $sql->execute();


    if( $sql->rowCount() > 0 ) {


        $sql = $sql->fetch();

        $_SESSION['banco'] = $sql['id'];


        header("Location: index.php");
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
            <h1>ACESSAR SUA CONTA</h1>  <br> 

            <p>Agência</p>
            <input type="number" name="agencia"  require>
             <br> 
             <p>Conta</p>
            <input type="number" name="conta"  require>
            <br> 
             <p>Senha</p> 
            <input type="number" name="senha"   require>
<br> 
            <button type="submit">Entrar</button>
        
        </form>

        <a href="cadastro.php" class="button">Cadastrar</a>
    </div>
</main>   
    
</body>
</html>