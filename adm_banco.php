<!DOCTYPE html>
<?php
include "./includes/menu.php";

if($acessovr < 2){
      echo "<script language='JavaScript'>
          		alert('Error: Você não tem permissão para acessar essa página');
          		window.location.href='./inicio.php'
         		 </script>";
}

require_once "./conexao/conexao.php";

$sqlSaque = "SELECT * FROM saque";
$resultSaque = mysqli_query($conexao, $sqlSaque);

$sqlDeposito = "SELECT * FROM deposito";
$resultDeposito = mysqli_query($conexao, $sqlDeposito);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Banco</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css" >
        <link rel="stylesheet" type="text/css" href="css/banco.css" >
        <style>
            .dep_adm{
                width: 150px;
                height: 80px;
                background-color: #ff6600;
                color: white;
                font-size: 30px;
                border: 1px black solid;
                margin-left: 45%;
                display: block;
                margin-top: 8px;
                cursor: pointer;
            }
            .deposito_adm{
                background-color: #ff0000;
                margin-left: 10px;
                height: 300px;
                width: 50%;
                left: 330px;
                position: absolute;
                margin-top: 250px;
                display: none;
            }
            
            .saque_adm{
                background-color: #ff0000;
                margin-left: 10px;
                height: 300px;
                width: 50%;
                left: 330px;
                position: absolute;
                margin-top: 100px;
                display: none;
            }
        </style>
    </head>
    <body>
        <br/>
        <h1 style="text-align: center">Banco</h1>
        <hr/><br/>
        <p style="text-align: center">
            Área de administração de saques e depositos</p>
        <div class="banco">
            <?php
            if (mysqli_num_rows($resultDeposito) != 0) {
                echo "DEPOSITOS<HR>";
            } else {
                echo "Não há ninguém realizando deposito no momento";
            }
            while ($vrdeposito = mysqli_fetch_assoc($resultDeposito)) {
                $verificarDeposito = $vrdeposito['verificar'];
                $idDeposito = $vrdeposito['serialcontas'];
                $valorDeposito = $vrdeposito['deposito'];
                $idnorr = $vrdeposito['RRID'];
                if ($verificarDeposito == 1) {
                    echo "<P> Id Da Conta:  $idDeposito </P><P> Valor Do Deposito:  $valorDeposito  </P> ID NO RR: $idnorr<HR>";
                }
            }
            ?>
        </div>
        <input class="dep_adm" id=btn_dep type=submit value=Depositos />
        <div id="deposito" class="deposito_adm">
            <center>
                <form method="POST" action="c_adm/requestNewDeposito.php">
                    <br>
                    <a id="fechardep" href=""> Fechar </a>
                    <p> Id do usuario </p>
                    <input class="saqdep" name="iduser" type="number" /><br>
                    <p>Valor do deposito</p>
                    <input class="saqdep" name=depvalor type="number" required autofocus /><br><br>
                    <input class="confirmar" type="submit" value="Confirmar" /><br>
                </form></center>
        </div>
        <div class="banco">
            <?php
            if (mysqli_num_rows($resultSaque) != 0) {
                echo "SAQUES<HR>";
            } else {
                echo "Não há ninguém realizando saques no momento";
            }
            while ($vrsaque = mysqli_fetch_assoc($resultSaque)) {
                $verificarSaque = $vrsaque['verificar'];
                $idSaque = $vrsaque['serialcontas'];
                $valorSaque = $vrsaque['saque'];
                $idnorr = $vrsaque['RRID'];
                if ($verificarSaque == 1) {
                    echo "<P> Id Da Conta:  $idSaque </P><P> Valor Do Saque:  $valorSaque  </P><P> ID NO RR: $idnorr</P><HR>";
                }
            }
            ?>
        </div>
    <input class="dep_adm" id=btn_saq type=submit value=Saques />
        <div id="saque" class="saque_adm">
            <center>
                <form method="POST" action="c_adm/requestNewSaque.php">
                    <br>
                    <a id="fechardep" href=""> Fechar </a>
                    <p> Id do usuario </p>
                    <input class="saqdep" name="iduser" type="number" /><br>
                    <p>Valor do Saque</p>
                    <input class="saqdep" name=saqvalor type="number" required autofocus /><br><br>
                    <input class="confirmar" type="submit" value="Confirmar" /><br>
                </form></center>
        </div>
        <script>
            var bnt = document.getElementById('btn_dep');
            var dv = document.getElementById('deposito');

            bnt.addEventListener('click', function () {
                dv.style.display = 'block';
            });
            
            var bt = document.getElementById('btn_saq');
            var div = document.getElementById('saque');

            bt.addEventListener('click', function () {
                div.style.display = 'block';
            });
        </script>
</html>
