<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: ../inicio.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="icon" type="imagem/png" href="imagens/icon.png" />
        <title>Login - RRBank</title>
    </head>
    <body>
        <div class="container">   
            <center>
                <h1>Tela de login</h1>
                <hr><br>
                <p class="text-center text-danger">
                    <?php
                    if (isset($_SESSION['loginErro'])) {
                        echo $_SESSION['loginErro'];
                        unset($_SESSION['loginErro']);
                    }
                    ?>
                </p><br>
                <form method="post" action="c/requestlogin.php">
                    Login:<br>
                    <input type="text" name="login" class="campo" maxlength="40" required autofocus><br>
                    Senha:<br>
                    <input type="password" name="senha" class="campo" maxlength="40"  required><br>
                    <br><br>
                    <input type="submit" value="Entrar" class="btn">
                    <br><br>
                </form>
                <br><br>
                <p>Não tem conta ? Crie já a sua </p><a class="nc" href="cadastro.php"> clique aqui </a> 
            </center>      
        </div>
    </body>
</html>