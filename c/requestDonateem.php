<?php

session_start();
require_once "../conexao/conexao.php";
include_once '../includes/menuWbd.php';

$donate = $_POST['donateem'];

$sql1 = "SELECT * FROM contas WHERE serial = '$exserial' LIMIT 1";
$result = mysqli_query($conexao, $sql1);
$resultado = mysqli_fetch_assoc($result);
$dinheiro = $resultado['dinheiro'];

if ($donate > $dinheiro) {
    echo "<script language='JavaScript'>
          		alert('Doação não realizada, não doe um valor que você não possua');
          		window.location.href='../caixa.php'
         		</script>";
    mysqli_close($conexao);
} else {
    $sql = "UPDATE contas SET dinheiro = dinheiro -'$donate' WHERE serial = '$exserial'";
    $salvar = mysqli_query($conexao, $sql);
    $sql2 = "UPDATE caixa SET dinheiro = dinheiro +'$donate' WHERE CaixaID = 1";
    $salvar2 = mysqli_query($conexao, $sql2);
    mysqli_close($conexao);
    header("Location: ../caixa.php");
}

