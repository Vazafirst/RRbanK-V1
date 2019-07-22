<?php

session_start();
require_once "../conexao/conexao.php";
include_once '../includes/menuWbd.php';

$deposito = $_POST['depvalor'];


if (isset($deposito)) {
    $sql = "UPDATE deposito SET deposito = '$deposito', verificar = '1' WHERE serialcontas = '$exserial'";
    $salvar = mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    header("Location: ../banco.php");
} else {
    "<script language='JavaScript'>
          		alert('Error ao realizar deposito, tente novamente');
                        window.location.href='../banco.php'
         		 </script>";
}
?>


