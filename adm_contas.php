<!DOCTYPE html>
<?php
include "./includes/menu.php";

if ($acessovr < 2) {
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
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>

    </head>
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
        Área de administração de contas</p>
    <div class="banco">
        <center>
            <form method="POST" action="">
                <br>
                <p> Código de verificação </p>
                <input class="saqdep" name="usercod" type="number" /><br>
                <input type="button" value="pesquisar" id="pesquisar"/>
            </form></center>
    </div>

    <div class="banco" id="usuarios">
        <center>
            <P> IGNORE A MENSAGEM DE ERROR ABAIXO</P><BR>
            <?php
            require_once './conexao/conexao.php';

            $uservr = $_POST['usercod'];

            $sql = "SELECT * FROM contas WHERE vr = '$uservr'";
            $pesquisar = mysqli_query($conexao, $sql);

            while ($rown = mysqli_fetch_array($pesquisar)) {
                $verificador = $rown['vr'];
                $verificadorserial = $rown['serial'];
                $verificadorlogin = $rown['login'];
                $verificadorrrname = $rown['nomenorr'];
                if ($verificador > 0) {
                    echo "<P> Id Da Conta:  $verificadorserial </P><P> Login do usuario:  $verificadorlogin </P><P>Nome no RR: $verificadorrrname </P><HR>";
                }
            }
            ?></center>
    </div>

    <div class="banco">
        <center>
            <form method="POST" action="c_adm/resquestConta.php">
                <br>
                <p> Serial do user </p>
                <input class="saqdep" name="userid" type="number" /><br>
                <p> Adicionar id no RR </p>
                <input class="saqdep" name="userrrid" type="number" /><br>
                <input type="submit" value="confirmar"/>
            </form></center>
    </div>

</html>
