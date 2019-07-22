<?php

session_start();
require_once "../conexao/conexao.php";
include_once '../includes/menuWbd.php';


$saque = $_POST['saqvalor'];

$sql1 = "SELECT * FROM contas WHERE serial = '$exserial' LIMIT 1";
$result = mysqli_query($conexao, $sql1);
$resultado = mysqli_fetch_assoc($result);
$dinheiro = $resultado['dinheiro'];


if ($saque > $dinheiro) {
    echo "<script language='JavaScript'>
          		alert('Saque não realizado, não saque um valor que você não possua');
          		window.location.href='../banco.php'
         		 </script>";
    mysqli_close($conexao);
} else {
    $sql = "UPDATE saque SET saque = '$saque', verificar = '1' WHERE serialcontas = '$exserial'";
    $salvar = mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    header("Location: ../banco.php");
}

