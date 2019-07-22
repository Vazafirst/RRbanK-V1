<!DOCTYPE html>
<?php
include "./includes/menu.php";

require_once "./conexao/conexao.php";

date_default_timezone_set('America/Sao_Paulo'); // Define a hora global como horário brasileiro
$diahj = date("Y-m-d H:i:s"); // Pega a data atual
$sql = "SELECT * FROM contas WHERE serial = '$exserial' LIMIT 1";
$result = mysqli_query($conexao, $sql);
$resultado = mysqli_fetch_assoc($result);
$dinheiro = $resultado['dinheiro'];
$diacad = $resultado['datacadastro'];
$dinheiroup = $resultado['dinheiroup'];
$datalimit = $resultado['datalimite'];
$verificarconta = $resultado['vr'];
$vrtiporendimento = $resultado['tipo'];

$sql2 = "SELECT * FROM banco WHERE serialcontas = '$exserial'";
$resultbanco = mysqli_query($conexao, $sql2);
$resultadobanco = mysqli_fetch_assoc($resultbanco);
$contabanco = $resultadobanco['serialcontas'];
$saldobanco = $resultadobanco['dinheiroup'];

$sqlSaque = "SELECT * FROM saque WHERE serialcontas = '$exserial'";
$resultSaque = mysqli_query($conexao, $sqlSaque);
$resultadoSaque = mysqli_fetch_assoc($resultSaque);
$verificarSaque = $resultadoSaque['verificar'];
$vrsaque = $resultadoSaque['saque'];

$sqlDeposito = "SELECT * FROM deposito WHERE serialcontas = '$exserial'";
$resultDeposito = mysqli_query($conexao, $sqlDeposito);
$resultadoDeposito = mysqli_fetch_assoc($resultDeposito);
$verificarDeposito = $resultadoDeposito['verificar'];
$vrdeposito = $resultadoDeposito['deposito'];

$depsaq = "";

if ($verificarDeposito == 1) {
    echo "<script type='text/javascript'>showWarn(this);</script>";
    $depsaqvalor = number_format($vrdeposito, 0, ",", ".");
    $depsaq = "<P style='text-align: center; color: greenyellow;'>O valor do seu depósito é:</P>" . "$" . $depsaqvalor;
}
if ($verificarSaque == 1) {
    echo "<script type='text/javascript'>showWarn(this);</script>";
    $depsaqvalor = number_format($vrsaque, 0, ",", ".");
    $depsaq = "<P style='text-align: center; color: greenyellow;'>O valor do seu saque é:</P>" . "$" . $depsaqvalor;
}

$perfilvr = "<a id='terms' class='terms' href='https://m.rivalregions.com/#slide/profile/812857693001919?1562921343360'> Avicii◢◤ </a>";
$vr = "";
$vracc = "";
if ($verificarconta > 0) {
    $vracc = "disabled";
    $exvr = "<P style='text-align: center; color: greenyellow;'>Parece que sua conta ainda não foi verificada<BR> você não será capaz de realizar saques e depósitos até verificar sua conta<BR> por favor envie o seguinte número<P style='text-align: center; color: red;'>$verificarconta</P><P style='text-align: center; color: greenyellow;'> para o privado do </P><P style='text-align: center; color: red;'>$perfilvr</P><P style='text-align: center; color: greenyellow;'> no RR<br> e aguarde a confirmação</P>";
} else {
    $exvr = "<p style='text-align: center; color: red; '> Atenção:</p><p style='text-align: center; color: greenyellow;'>  Só realize depósitos após enviar o dinheiro no RR, pois ele poderá ser cancelado caso nenhum valor for recebido no jogo</p>
            <p style='text-align: center; color: ffc806; '> conta para depósito: $perfilvr </P><BR>
        <p style='text-align: center; color: red; '> Atenção:</p><p style='text-align: center; color: greenyellow;'> Saques e/ou depósitos podem demorar até 5 horas para serem confirmados</p><br>
        <p style='text-align: center; color: red; '> Atenção:</p><p style='text-align: center; color: greenyellow;'> Rendimento diário rende 1% por dia e semanal rende 10% por semana</p><br>
<p style='text-align: center; color: red; '> Atenção:</p><p style='text-align: center; color: greenyellow;'> Ao mudar o tipo de rendimento a data da próxima atualização mudará</p>
         ";
}

if ($vrtiporendimento == 1) {
    $data = date('Y/m/d H:i:s', strtotime("+1 days", strtotime($diahj)));
    $porc = 1 / 100; // Porcentagem de rendimento
    $valor = ($porc * $dinheiro); // Multiplica a porcentagem pelo dinheiro atual
} else {
    $data = date('Y/m/d H:i:s', strtotime("+7 days", strtotime($diahj)));
    $porc = 10 / 100; // Porcentagem de rendimento
    $valor = ($porc * $dinheiro); // Multiplica a porcentagem pelo dinheiro atual
}

if (isset($contabanco)) {
    $sql4 = "UPDATE contas SET dinheiroup = '$valor' WHERE serial = '$exserial'";
    $salvar4 = mysqli_query($conexao, $sql4);
}
//
// Se o saldo do banco e o dinheiro da conta forem diferentes ele será atualizado aqui
if ($saldobanco != $dinheiroup) {
    $sql3 = "UPDATE banco SET dinheiroup = '$valor' WHERE serialcontas = '$exserial'";
    $salvar3 = mysqli_query($conexao, $sql3);
}
?>
<script type="text/javascript">

    function showWarn()
    {
        document.getElementById('warn').style.display = "block";
    }
    function hideWarn()
    {
        document.getElementById('warn').style.display = "none";
    }

</script>
<script type="text/javascript">

    function showWarn2()
    {
        document.getElementById('warn2').style.display = "block";
    }
    function hideWarn2()
    {
        document.getElementById('warn2').style.display = "none";
    }

</script>
<html>
    <head>
        <?php ?>
        <meta charset="UTF-8">
        <title>Banco</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css" >
        <link rel="stylesheet" type="text/css" href="css/banco.css" >
    </head>
    <body>
        <br/>
        <h1 style="text-align: center">Banco</h1>
    <hr/><center><?php include_once './c/verificarOnline.php'; ?><br><br></center>
    <div class="warn" id="warn" >
        <p style="text-align: center; color: red;">Você tem uma transação em andamento e não poderá realizar outra até essa ser confirmada<br>Por favor aguarde</p>
        <center>
            <?php echo $depsaq; ?>
        </center>
    </div><br>
    <div class="warn2" id="warn2" >
        <?php echo $exvr; ?>   
    </div><br>
    <?php
    if ($verificarDeposito == 1) {
        echo "<script type='text/javascript'>showWarn(this);</script>";
        $vr = "disabled";
    }
    if ($verificarSaque == 1) {
        echo "<script type='text/javascript'>showWarn(this);</script>";
        $vr = "disabled";
    }
    if ($verificarconta > 0) {
        echo "<script type='text/javascript'>showWarn2(this);</script>";
        $vracc = "disabled";
    }
    ?>

    <div class="banco">
        <form method="POST" action="c/requestRendimento.php" >
            <center> <p>Tipo de rendimento:<br> <input type="radio" id="tipo" name="tipo" value="1"> Diario <br>
                    <input type="radio" id="tipo1" name="tipo" value="0"> Semanal</p>
                <input type="submit" class="bntconf" id="btnconf" name="confirmar" value="confirmar"><br><br>
            </center>
        </form>

        <?php
        $valor1 = number_format($saldobanco, 0, ",", ".");
        $saldo = number_format($dinheiro, 0, ",", ".");
        echo "<p class=atual>Seu saldo atual é: <br><br><p class=dat>$saldo</p> <br><br></p>";
        echo "<p class=up>Seu dinheiro renderá: <br><br><p class=dat>$valor1</p><br><br></p>";
        ?>
        <?php
        $dia_hora_atual = strtotime(date("Y-m-d H:i:s"));

        $dia_hora_evento = strtotime(date($datalimit));

        $diferenca = $dia_hora_evento - $dia_hora_atual;

        $dias = intval($diferenca / 86400);

        $marcador = $diferenca % 86400;

        $hora = intval($marcador / 3600);

        $marcador = $marcador % 3600;

        $minuto = intval($marcador / 60);

        $segundos = $marcador % 60;

        echo "<P style='text-align: center;'> Proxíma atualização em: $dias dia(s) $hora hora(s) $minuto minuto(s) </P>";
        ?>
    </div><br>
    <div class="btn">
        <?php echo "<input class=dep id=btn_dep type=submit  $vracc $vr value=Depositar />"; ?>
        <?php echo "<input class=saq id=btn_saq type=submit $vracc $vr value=Sacar />"; ?>
    </div><br>
    <div id="saque" class="saque" >
        <center>
            <form method="POST" action="c/requestSaque.php">
                <br><br>
                Digite o valor que deseja retirar da sua conta<br><br>
                <input class="saqdep" name="saqvalor" type="number" required autofocus /><br><br>
                <input class="confirmar" type="submit" value="Confirmar" /><br>
                <a id="fecharsaq" href=""> Fechar </a>
            </form></center>
    </div>  
    <div id="deposito" class="deposito">
        <center>
            <form method="POST" action="c/requestDeposito.php">
                <br><br>
                Digite o valor que deseja depósitar na sua conta<br><br>
                <input class="saqdep" name="depvalor" type="number" required autofocus /><br><br>
                <input class="confirmar" type="submit" value="Confirmar" /><br>
                <a id="fechardep" href=""> Fechar </a>
            </form></center>
    </div>
    <script>
        var btn = document.getElementById('btn_saq');
        var div = document.getElementById('saque');
        var bnt = document.getElementById('btn_dep');
        var dv = document.getElementById('deposito');
        var bnt1 = document.getElementById('btnconf');
        var bnt2 = document.getElementById('tipo');
        var bnt3 = document.getElementById('tipo1');

        btn.addEventListener('click', function () {
            div.style.display = 'block';
            dv.style.display = 'none';
        });
        bnt.addEventListener('click', function () {
            dv.style.display = 'block';
            div.style.display = 'none';
        });

        bnt2.addEventListener('click', function () {
            bnt1.style.display = 'block';
        });

        bnt3.addEventListener('click', function () {
            bnt1.style.display = 'block';
        });
    </script>

</html>
