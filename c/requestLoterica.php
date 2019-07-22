<?php

require_once "../conexao/conexao.php";
include_once '../includes/menuWbd.php';

$loto = $_POST['loto'];

$valoraposta = 3000000000;
$caixaid = 2;


$sql1 = "SELECT * FROM contas WHERE serial = '$exserial' LIMIT 1";
$result = mysqli_query($conexao, $sql1);
$resultado = mysqli_fetch_assoc($result);
$dinheiro = $resultado['dinheiro'];

$sql2 = "SELECT * from loterica WHERE serialcontas = '$exserial'";
$result2 = mysqli_query($conexao, $sql2);
$resultado2 = mysqli_fetch_assoc($result2);
$valorlot = $resultado2['valorlot'];

if ($loto == 0) {
    echo "<script language='JavaScript'>
          		alert('Você não pode apostar um valor menor que 1');
          		window.location.href='../loterica.php'
         		 </script>";
} else {
    if ($loto >= 101) {
        echo "<script language='JavaScript'>
          		alert('Você não pode apostar um valor maior que 100');
          		window.location.href='../loterica.php'
         		 </script>";
    } else {
        if ($valoraposta > $dinheiro) {
            echo "<script language='JavaScript'>
          		alert('Você não tem saldo suficiente para realizar essa aposta, realize um deposito');
          		window.location.href='../banco.php'
         		 </script>";
            mysqli_close($conexao);
        } else {
            if ($loto == $valorlot) {
                echo "<script language='JavaScript'>
          		alert('Você não pode apostar o número atual da loterica, tente outro');
          		window.location.href='../loterica.php'
         		 </script>";
            } else {
                $sqlapostador = "UPDATE apostadores SET apostanum = '$loto' WHERE serialcontas = '$exserial'";
                $salvarapostador = mysqli_query($conexao, $sqlapostador);
                $sqlapostador1 = "UPDATE apostadores SET apostou = 1 WHERE serialcontas = '$exserial'";
                $salvarapostador1 = mysqli_query($conexao, $sqlapostador1);
                $sqlsaldo = "UPDATE contas SET dinheiro = dinheiro - '$valoraposta' WHERE serial = '$exserial'";
                $salvarsaldo = mysqli_query($conexao, $sqlsaldo);
                $sqlcaixa = "UPDATE caixa SET dinheiro = dinheiro + '$valoraposta' WHERE CaixaID = '2'";
                $salvarcaixa = mysqli_query($conexao, $sqlcaixa);
                mysqli_close($conexao);
                header("Location: ../loterica.php");
            }
        }
    }
}