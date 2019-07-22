<?php

 require_once './conexao/conexao.php';

 // Donate evento \/
 
$tipoev = 1;
$SQL = "SELECT evid, acabou, descricao FROM eventos WHERE ev_tipo = '$tipoev'";
$result = mysqli_query($conexao, $SQL);

// Work evento \/

$tipoev2 = 2;
$SQL2 = "SELECT evid, acabou, descricao FROM eventos WHERE ev_tipo = '$tipoev2'";
$result2 = mysqli_query($conexao, $SQL2);

// War evento \/

$tipoev3 = 3;
$SQL3 = "SELECT evid, acabou, descricao FROM eventos WHERE ev_tipo = '$tipoev3'";
$result3 = mysqli_query($conexao, $SQL3);