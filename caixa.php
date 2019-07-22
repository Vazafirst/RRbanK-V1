<!DOCTYPE html>
<?php
include "./includes/menu.php";

require_once "./conexao/conexao.php";

$caixaemer = 1;
$caixaev = 2;

$sql1 = "SELECT dinheiro FROM caixa WHERE CaixaID = '$caixaev' LIMIT 1";
$resultcx = mysqli_query($conexao, $sql1);
$eventors = mysqli_fetch_assoc($resultcx);
$evento = $eventors['dinheiro'];
$sql2 = "SELECT dinheiro FROM caixa WHERE CaixaID = '$caixaemer' LIMIT 1";
$resultem = mysqli_query($conexao, $sql2);
$emergencialrs = mysqli_fetch_assoc($resultem);
$emergencial = $emergencialrs['dinheiro'];

$perfilvr = "<a id='terms' class='terms' href='https://m.rivalregions.com/#slide/profile/812857693001919?1562921343360'> Avicii◢◤ </a>";
$vracc = "";
if ($verificarconta > 0) {
    $vracc = "disabled";
    $exvr = "<P style='text-align: center; color: greenyellow;'>Parece que sua conta ainda não foi verificada<BR> você não será capaz de realizar doações para os caixas do banco<BR> por favor envie o seguinte número<P style='text-align: center; color: red;'>$verificarconta</P><P style='text-align: center; color: greenyellow;'> para o privado do </P><P style='text-align: center; color: red;'>$perfilvr</P><P style='text-align: center; color: greenyellow;'> no RR<br> e aguarde a confirmação</P>";
} else {
    $exvr = "<p style='text-align: center; color: red; '> Caixa emergencial</p><p style='text-align: center; color: greenyellow;'> Os caixas são sistemas de segurança para organização de saldo para casos especifícos</p>
        <p style='text-align: center; color: greenyellow;'> O caixa emergencial serve para guardar uma quantidade de dinheiro para casos emergenciais para podermos devolver todo o seu dinheiro depósitado no banco</p>
        <p style='text-align: center; color: red; '> Caixa eventos</p><p style='text-align: center; color: greenyellow;'> O caixa de eventos serve para guardar o dinheiro para realizar eventos, é dele que sairá o dinheiro dos prêmios </p>";
}
?>
<html>
    <head>
        <?php ?>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css" >
        <link rel="stylesheet" type="text/css" href="css/caixa.css" >
    </head>
    <body>
        <br/>
        <h1 style="text-align: center">Caixa</h1>
    <hr><center><?php include_once './c/verificarOnline.php'; ?><br><br></center>
    <div class="warn2" id="warn2" >
        <?php echo $exvr; ?>   
    </div><br>
    <div class="caixa">
        <?php
        $valor1 = number_format($emergencial, 0, ",", ".");
        echo "<br><p class=emerg>Saldo no caixa emergencial: <br><br><p class=dat>$valor1</p> <br><br></p>";
        ?>
    </div>
    <center>
        <?php echo "<input class=doar id=btn_emer $vracc type=submit value=Doar />" ?>
    </center>
    <div class="caixa">
        <?php
        $saldo = number_format($evento, 0, ",", ".");
        echo "<br><p class=event>Seu saldo no caixa de eventos: <br><br><p class=dat>$saldo</p> <br><br></p>";
        ?>
    </div>
    <center>
        <?php echo "<input class=doar id=btn_ev $vracc type=submit value=Doar />"; ?>
    </center>
    <div id="donateev" class="donateev">
        <center>
            <form method="POST" action="c/requestDonateev.php">
                <br><br>

                Digite o valor que deseja doar para o caixa de eventos<br><br>
                <input class="evemer" name="donateev" type="number" required autofocus /><br><br>
                <input class="confirmar" type="submit" value="Confirmar" /><br>
                <a id="fechardep" href=""> Fechar </a>
            </form></center>
    </div>

    <div id="donateemer" class="donateemer">
        <center>
            <form method="POST" action="c/requestDonateem.php">
                <br><br>

                Digite o valor que deseja doar para o caixa emergencial<br><br>
                <input class="evemer" name="donateem" type="number" required autofocus /><br><br>
                <input class="confirmar" type="submit" value="Confirmar" /><br>
                <a id="fechardep" href=""> Fechar </a>
            </form></center>
    </div>
    <script>
        var btn = document.getElementById('btn_ev');
        var div = document.getElementById('donateev');
        var bnt = document.getElementById('btn_emer');
        var dv = document.getElementById('donateemer');

        btn.addEventListener('click', function () {
            div.style.display = 'block';
            dv.style.display = 'none';
        });
        bnt.addEventListener('click', function () {
            dv.style.display = 'block';
            div.style.display = 'none';
        });
    </script>
</html>
