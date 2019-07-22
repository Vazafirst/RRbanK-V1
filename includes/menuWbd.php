<input type="checkbox" id="bt_menu">
<label for="bt_menu">&#9776;</label>

<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    $_SESSION['loginErro'] = "Logue para acessar o site";
    header('location:index.php');
}
$logado = $_SESSION['login'];

$sqlSerial = "SELECT * FROM contas WHERE login = '$logado'";
$resultSerial = mysqli_query($conexao, $sqlSerial);
$resultadoSerial = mysqli_fetch_assoc($resultSerial);
$exserial = $resultadoSerial['serial'];
$acessovr = $resultadoSerial['adm'];
?>
<title>RRBanK</title>
<nav class="menu">
    <center>
        <ul>
            <li><a href="../inicio.php" >Inicio</a></li>
            <li><a href="#" >Conta</a>
                <ul>
                    <li><a href="../perfil.php" >Perfil</a>
                    </li>
                    <li><a href="../banco.php" >Banco</a>
                    </li>
                </ul>
            </li>
            <li><a href="#" >Sobre</a>
                <ul>
                    <li><a href="../caixa.php" >Caixa 2</a>
                    </li>
                    <li><a href="../eventos.php" >Eventos</a>
                    </li>
                    <li><a href="../atts.php" >Atualizações</a>
                    </li>
                </ul>
            </li>
            <li><a href="rrbank/../logout.php" >Sair</a></li>
        </ul>
    </center>
</nav>
