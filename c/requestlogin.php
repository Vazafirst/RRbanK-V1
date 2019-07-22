<?php

session_start();
require_once("../conexao/conexao.php");

if ((isset($_POST['login'])) && (isset($_POST['senha']))) {
    $login = mysqli_real_escape_string($conexao, $_POST['login']);
    $senha = sha1($_POST['senha']);
    $sql = "SELECT * FROM contas WHERE login = '$login' && senha = '$senha' LIMIT 1";
    $result = mysqli_query($conexao, $sql);
    $resultado = mysqli_fetch_assoc($result);
    $senhabd = $resultado['senha'];
    $error = $_POST['senha'] != $resultado['senha'];

    if ($senhabd == $senha) {
        $sucess = 'ok';
    } else {
        $sucess = 'error';
    }
    if (empty($resultado)) {
        $_SESSION['loginErro'] = "Login ou senha inválidos";
        header("Location: ../index.php");
    } elseif (isset($resultado) && $sucess == 'ok') {
        setcookie('login', $login);
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        $_SESSION["sessiontime"] = time() + 60;
        header("Location: ../inicio.php");
    } else {
        $_SESSION['loginErro'] = "Login ou senha inválidos";
        header("Location: ../index.php");
    }
}
?>