<?php

require_once "../conexao/conexao.php";
include_once '../includes/menuWbd.php';

$_POST['tipo'];

$tipo = $_POST['tipo'];

date_default_timezone_set('America/Sao_Paulo'); // Define a hora global como horário brasileiro
$diahj = date("Y-m-d H:i:s"); // Pega a data atual

$sql = "SELECT * FROM contas WHERE serial = '$exserial' LIMIT 1";
$result = mysqli_query($conexao, $sql);
$resultado = mysqli_fetch_assoc($result);
$saldo = $resultado['dinheiro'];

if ($tipo == 1) {
    $sqlcontas1 = "UPDATE contas SET tipo = '1' WHERE serial = '$exserial'";
    $salvarcontas1 = mysqli_query($conexao, $sqlcontas1);
    $data = date('Y/m/d H:i:s', strtotime("+1 days", strtotime($diahj)));
    $sqldata = "UPDATE contas SET datalimite = '$data' WHERE serial = '$exserial'";
    $salvardata = mysqli_query($conexao, $sqldata);
    $porc = 1 / 100; // Porcentagem de rendimento
    $valor = ($porc * $saldo); // Multiplica a porcentagem pelo dinheiro atual
    $sql3 = "UPDATE banco SET dinheiroup = '$valor' WHERE serialcontas = '$exserial'";
    $salvar3 = mysqli_query($conexao, $sql3);
    mysqli_close($conexao);
    header("Location: ../banco.php");
} else {
    $sqlcontas = "UPDATE contas SET tipo = '0' WHERE serial = '$exserial'";
    $salvarcontas = mysqli_query($conexao, $sqlcontas);
    $data = date('Y/m/d H:i:s', strtotime("+7 days", strtotime($diahj)));
    $sqldata1 = "UPDATE contas SET datalimite = '$data' WHERE serial = '$exserial'";
    $salvardata1 = mysqli_query($conexao, $sqldata1);
    $porc = 10 / 100; // Porcentagem de rendimento
    $valor = ($porc * $saldo); // Multiplica a porcentagem pelo dinheiro atual
    $sql3 = "UPDATE banco SET dinheiroup = '$valor' WHERE serialcontas = '$exserial'";
    $salvar3 = mysqli_query($conexao, $sql3);
    mysqli_close($conexao);
    header("Location: ../banco.php");
}
