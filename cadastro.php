<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/cad.css">
        <link rel="icon" type="imagem/png" href="imagens/icon.png" />
        <title>Cadastro - RRBank</title>
        <script type="text/javaScript">
            function Trim(str){
            return str.replace(/^\s+|\s+$/g,"");
            }
        </script>
    </head>
    <body>
        <div class="container">   
            <center>
                <h1>Crie sua conta</h1>
                <hr><br><br>

                <?php
                if (isset($_SESSION['CadErro'])) {
                    echo $_SESSION['CadErro'];
                    unset($_SESSION['CadErro']);
                }
                ?>

                <form method="POST" action="c/requestcadastro.php">
                    Login:<br>
                    <input type="text" name="login" placeholder="Escolha um login" pattern="[a-zA-Z0-9]+" class="campo" onkeyup="this.value = Trim(this.value)" minlength="3" maxlength="40" required autofocus><br>
                    Senha:<br>
                    <input type="password" name="senha" placeholder="Insira uma senha" class="campo" maxlength="40" required ><br>
                    Email:<br>
                    <input type="email" name="email" placeholder="Coloque seu email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="campo" maxlength="50" required><br>
                    Nome no RR:<br>
                    <input type="text" name="rrname" placeholder="Seu nick no RR" class="campo" maxlength="40" required ><br>
                    <br><br>
                    <input type="submit" name="btCad" value="Confirmar" class="btn">
                    <br><br>
                    <input type="checkbox" value="check" class="box" required>
                    Ao criar a conta no RRBank você confirma que leu e concorda com os nossos <a id="terms" class="terms" href="#"> termos de uso </a>
                </form>
            </center>      
        </div>
        <div class="termos" id="termos">
            <center>
                <textarea readonly="true" class="textterm" > Termos de uso RR Bank, blá blá blá, tu nem vai ler isso aqui mesmo mas....			
Ao criar uma conta no rrbank você concorda em dar acesso as suas finanças no jogo(disponibilizadas por você através de saques e depósitos).
Sua imagem de perfil e nome no jogo poderão ser usados para eventos do rrbank dentro do mesmo.
Pequenas porcentagens do seu saldo bancário dentro do rrbank poderão ser revertidos na caixa para eventos(Um caixa com dinheiro exclusivo para realização de eventos e etc...) do banco.
O ID do seu perfil no jogo poderá ser usado para sistemas de saques e depósitos automáticos no futuro.
A imagem e nome do seu perfil no jogo poderá ser usada para criação de artigos de propaganda do rrbank </textarea>
                <input class="fecharcad" id="btn_fechar" type="button" value="Fechar" />
            </center>
        </div>
        <script>
            var btn = document.getElementById('terms');
            var div = document.getElementById('termos');
            btn.addEventListener('click', function () {
                div.style.display = 'block';
            }); // Faz os termos aparecer na tela
            var bnt = document.getElementById('btn_fechar');
            bnt.addEventListener('click', function () {
                div.style.display = 'none';
            }); // fecha os termos
        </script>    
    </body>
</html>
