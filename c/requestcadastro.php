<?php

session_start();
require_once("../conexao/conexao.php");
$socket = fsockopen('udp://pool.ntp.br', 123, $err_no, $err_str, 1);
date_default_timezone_set('America/Sao_Paulo');

if ($socket) {
    if (fwrite($socket, chr(bindec('00' . sprintf('%03d', decbin(3)) . '011')) . str_repeat(chr(0x0), 39) . pack('N', time()) . pack("N", 0))) {

        stream_set_timeout($socket, 1);
        $unpack0 = unpack("N12", fread($socket, 48));
        $rst = date('Y-m-d H:i:s', $unpack0[7]);
    }
}

$login = $_POST["login"];
$senha = sha1($_POST["senha"]);
$email = $_POST["email"];
$rrname = $_POST["rrname"];
$fon = rand(10000000, 99999999);

$checkn = "SELECT * FROM contas WHERE login = '$login'";
$sqlcheckn = mysqli_query($conexao, $checkn);
$rowsn = mysqli_num_rows($sqlcheckn);

if ($rowsn == 0) {
    $sql = "insert into contas (login, senha, email, nomenorr, datacadastro, datalimite, vr) values ('$login', '$senha', '$email', '$rrname', '$rst', '$rst', '$fon')";
    $salvar = mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    header("Location: ../inicio.php");
} else {
    $_SESSION['CadErro'] = "<P style=color red>Parece que essa conta já existe<BR> Tente novamente</P>";
    header("Location: ../cadastro.php");
}
fclose($socket);
?>