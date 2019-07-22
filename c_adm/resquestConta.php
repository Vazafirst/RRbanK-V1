<?php

require_once '../conexao/conexao.php';

$userid = $_POST['userid'];
$rrid = $_POST['userrrid'];


$sql1 = "SELECT * FROM contas WHERE serial = '$userid'";
$result = mysqli_query($conexao, $sql1);
$resultado = mysqli_fetch_assoc($result);


    $sql = "UPDATE contas SET RRID = '$rrid' ,vr = '0' WHERE serial = '$userid'";
    $salvar = mysqli_query($conexao, $sql);
    mysqli_close($conexao);
   header("Location: ../adm_contas.php");


