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

$sqlContas = "SELECT sum(dinheiro) as dinheiro FROM contas";
$resultContas = mysqli_query($conexao, $sqlContas);
$resultado = mysqli_fetch_assoc($resultContas);

$Resultadoall = $resultado['dinheiro'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Banco</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css" >
        <link rel="stylesheet" type="text/css" href="css/banco.css" >
    </head>
</head>
<body>
    <br/>
    <h1 style="text-align: center">Stats</h1>
    <hr/><br/>
    <p style="text-align: center">
        Área de exibição de dados do banco</p>
    <div class="banco" id="usuarios">
        <center>
            
            <?php
            $total = number_format($Resultadoall, 0, ",", ".");
            echo "<P> Dinheiro total depositado no banco </P><br>" . $total;
            ?></center>

        
        
    </div>

</html>
