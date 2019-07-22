 <?php
session_start();
require_once("./conexao.php");
$logado = $_SESSION['login'];


$nome = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$rrname = filter_input(INPUT_POST, 'rrnick', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

echo "Nome : $nome<br>";
echo "RRNome : $rrname<br>";
echo "Email : $email<br>";
echo "$logado";

$sql = "UPDATE contas SET nome='$nome', email='$email', nomenorr='$rrname', WHERE login='$logado'";
$salvar = mysqli_query($conexao, $sql);

if(mysqli_affected_rows($conexao)){
    $_SESSION['msg'] = "<p style='color: green;'>Dados editados com sucesso</p>";
    header("Location: perfil.php");
}else{
    $_SESSION['msg'] = "<p style='color: red;'>Error ao editar dados</p>";
    header("Location: editarp.php");
}

?>