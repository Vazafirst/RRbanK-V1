<?php

session_start();
require_once("../conexao/conexao.php");

date_default_timezone_set('America/Sao_Paulo'); // Define a hora global como horário brasileiro
$diahj = date("Y-m-d H:i:s"); // Pega a data atual

$serial = $_POST['iduser'];
$deposito = $_POST['saqvalor'];

$sql = "UPDATE saque SET saque = '0', verificar = '0' WHERE serialcontas = '$serial'";
$salvar = mysqli_query($conexao, $sql);

$sql1 = "UPDATE contas SET dinheiro = dinheiro - '$deposito' WHERE serial = '$serial'";
$salvar1 = mysqli_query($conexao, $sql1);

$sql0 = "SELECT * FROM contas WHERE serial = '$serial' LIMIT 1";
$result = mysqli_query($conexao, $sql0);
$resultado = mysqli_fetch_assoc($result);
$datalimite = resultado['datalimite'];
$dinheiro = $resultado['dinheiro'];
$dinheiroup = $resultado['dinheiroup'];
$vrtiporendimento = $resultado['tipo'];

$sql2 = "SELECT * FROM banco WHERE serialcontas = '$serial'";
$resultbanco = mysqli_query($conexao, $sql2);
$resultadobanco = mysqli_fetch_assoc($resultbanco);
$contabanco = $resultadobanco['serialcontas'];
$saldobanco = $resultadobanco['dinheiroup'];


if ($vrtiporendimento == 1) {
    $porc = 1 / 100; // Porcentagem de rendimento
    $valor = ($porc * $dinheiro); // Multiplica a porcentagem pelo dinheiro atual
}
if ($vrtiporendimento == 0) {
    $porc = 10 / 100; // Porcentagem de rendimento
    $valor = ($porc * $dinheiro); // Multiplica a porcentagem pelo dinheiro atual
}

if (isset($contabanco)) {
    $sql4 = "UPDATE contas SET dinheiroup = '$valor' WHERE serial = '$serial'";
    $salvar4 = mysqli_query($conexao, $sql4);
    $sql = "UPDATE banco SET dinheiroup = '$valor' WHERE serialcontas = '$serial'";
    $salvar = mysqli_query($conexao, $sql);
    echo $valor;
    mysqli_close($conexao);
    header("Location: ../adm_banco.php");
}
//