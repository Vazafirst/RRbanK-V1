<!DOCTYPE html>
<?php
include_once './includes/menu.php';
require_once './conexao/conexao.php';

date_default_timezone_set('America/Sao_Paulo');
$diahj = date("Y-m-d H:i:s");

$numloterica = rand(1, 100);

$premiovalor = 100000000000;

$caixaevid = 2;
$idlot = 1;

$sqlcontas = "SELECT * FROM contas WHERE serial = $exserial";
$resultcontas = mysqli_query($conexao, $sqlcontas);
$resultadocontas = mysqli_fetch_assoc($resultcontas);
$saldoatual = $resultadocontas['dinheiro'];
$verificarconta = $resultadocontas['vr'];

$sqlcaixa = "SELECT * FROM caixa WHERE CaixaID = 2";
$resultcaixa = mysqli_query($conexao, $sqlcaixa);
$resultadocaixa = mysqli_fetch_assoc($resultcaixa);
$caixaeventos = $resultadocaixa['dinheiro'];

$sql = "SELECT * FROM loterica WHERE serialcontas = '$exserial'";
$result = mysqli_query($conexao, $sql);
$resultado = mysqli_fetch_assoc($result);
$valorlot = $resultado['valorlot'];
$dataresult = $resultado['dataresult'];

$sqlaposta = "SELECT * FROM apostadores WHERE serialcontas = $exserial";
$resultaposta = mysqli_query($conexao, $sqlaposta);
$resultadoaposta = mysqli_fetch_assoc($resultaposta);
$resultadoaposta['apostanum'];
$apostanum = $resultadoaposta['apostanum'];
$caixavr = $resultadoaposta['caixavr'];
$apostouvr = $resultadoaposta['apostou'];

$sqlexaposta = "SELECT * FROM lotericars WHERE serialcontas = '$exserial'";
$resultex = mysqli_query($conexao, $sqlexaposta);
$resultadoex = mysqli_fetch_assoc($resultex);
$valorlot2 = $resultadoex['valorlot'];

$sqlapostadornum = "SELECT * FROM apostadoresrs WHERE serialcontas = $exserial";
$resultapostadornum = mysqli_query($conexao, $sqlapostadornum);
$resultadoapostadornum = mysqli_fetch_assoc($resultapostadornum);
$apostadornum = $resultadoapostadornum['apostanum'];

if ($dataresult <= $diahj) {
    $salvarapostanum = "UPDATE apostadoresrs SET apostanum = '$apostanum' WHERE serialcontas = '$exserial'";
    $salvarapostadornum = mysqli_query($conexao, $salvarapostanum);
    $sorteiosql = "UPDATE loterica SET valorlot = '$numloterica' WHERE serialcontas = '$exserial'";
    $salvarsorteio = mysqli_query($conexao, $sorteiosql);
    $data = date('Y/m/d H:i:s', strtotime("+1 Days", strtotime($diahj)));
    $sqldata = "UPDATE loterica SET dataresult = '$data' WHERE serialcontas = '$exserial'";
    $salvardata = mysqli_query($conexao, $sqldata);
    $sql = "SELECT * FROM loterica WHERE serialcontas = '$exserial'";
    $result = mysqli_query($conexao, $sql);
    $resultado = mysqli_fetch_assoc($result);
    $valorlot = $resultado['valorlot'];
    $sorteiosqlex = "UPDATE lotericars SET valorlot = '$valorlot' WHERE serialcontas = '$exserial'";
    $salvarsorteioex = mysqli_query($conexao, $sorteiosqlex);
    $sorteiosql2 = "UPDATE loterica SET valorlot = '200' WHERE serialcontas = '$exserial'";
    $salvarsorteio2 = mysqli_query($conexao, $sorteiosql2);
    $sorteiosql3 = "UPDATE apostadores SET apostanum = '0' WHERE serialcontas = '$exserial'";
    $salvarsorteio3 = mysqli_query($conexao, $sorteiosql3);
    $sqlapostador3 = "UPDATE apostadores SET apostou = '0' WHERE serialcontas = '$exserial'";
    $salvarapostador3 = mysqli_query($conexao, $sqlapostador3);
    echo "<meta http-equiv='refresh' content='3.5;URL=http://rrbank.ifasthost.xyz/loterica.php' />";
}

$vrapostou = "";

if ($apostouvr == 1) {
    echo "<script type='text/javascript'>showWarn(this);</script>";
    $vrapostou = "disabled";
}

$perfilvr = "<a id='terms' class='terms' href='https://m.rivalregions.com/#slide/profile/812857693001919?1562921343360'> Avicii◢◤ </a>";
$vracc = "";
if ($verificarconta > 0) {
    $vracc = "disabled";
    $exvr = "<P style='text-align: center; color: greenyellow;'>Parece que sua conta ainda não foi verificada<BR> você não será capaz de realizar apostas<BR> por favor envie o seguinte número<P style='text-align: center; color: red;'>$verificarconta</P><P style='text-align: center; color: greenyellow;'> para o privado do </P><P style='text-align: center; color: red;'>$perfilvr</P><P style='text-align: center; color: greenyellow;'> no RR<br> e aguarde a confirmação</P>";
} else {
    $exvr = "<p style='text-align: center; color: red; '> Atenção:</p><p style='text-align: center; color: greenyellow;'> Ao realizar uma aposta o dinheiro será automaticamente retirado da sua conta e irá para o caixa de eventos</p><br>
        <p style='text-align: center; color: red; '> Atenção: </p><p style='text-align: center; color: greenyellow;'> Você terá que logar todo dia e acessar essa página para a contagem de tempo resetar e você receber seu prêmio </p><br>";
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/loterica.css">
    </head>
    <body>
        <br>
        <h1 style="text-align: center;" >Lotérica</h1>
    <hr><center><?php include_once './c/verificarOnline.php'; ?><br><br></center>
    <div class="warn2" id="warn2" >
        <?php echo $exvr; ?>   
    </div><br>
    <div class="conteudo" >
        <br> <P> Número sorteado </P><br>
        <div class="apostaresult">
            <?php echo "<P class=numerosorteio>" . $valorlot2 . "</P>" ?>
        </div><br>
        <p>Valor do prêmio: $ 100.000.000.000</p><br>
        <?php
        $dia_hora_atual = strtotime(date("Y-m-d H:i:s"));

        $dia_hora_evento = strtotime(date($dataresult));

        $diferenca = $dia_hora_evento - $dia_hora_atual;

        $dias = intval($diferenca / 86400);

        $marcador = $diferenca % 86400;

        $hora = intval($marcador / 3600);

        $marcador = $marcador % 3600;

        $minuto = intval($marcador / 60);

        $segundos = $marcador % 60;

        echo "<P style='text-align: center;'> Proxímo sorteio em:<BR> $hora hora(s) $minuto minuto(s) $segundos segundos </P><BR>";
        ?>    
        <hr><br>
        <?php
        echo "<P> Aposta número: <P class=numerosorteio>" . $apostanum . "</P><BR><HR><BR>";
        echo "<P> Sua última aposta foi: " . $apostadornum . "</P><BR><HR><BR>";
        if ($valorlot == $apostanum) {
            $sqlganhou = "UPDATE contas SET dinheiro = dinheiro + '$premiovalor' WHERE serial = '$exserial'";
            $salvarganhos = mysqli_query($conexao, $sqlganhou);
            $sqlapostador = "UPDATE apostadores SET apostanum = '0' WHERE serialcontas = '$exserial'";
            $salvarapostador = mysqli_query($conexao, $sqlapostador);
            $sqlapostador3 = "UPDATE apostadores SET caixavr = '1' WHERE serialcontas = '$exserial'";
            $salvarapostador3 = mysqli_query($conexao, $sqlapostador3);
            echo "<P> Você venceu !!</P><BR><HR><BR>";
            echo "<meta http-equiv='refresh' content='15;URL=http://rrbank.ifasthost.xyz/loterica.php' />";
            echo "A página será atualizada daqui a 15 segundos para sincronizar seu saldo";
        } if ($caixavr == 1) {
            $sqlcaixaev = "UPDATE caixa SET dinheiro = dinheiro - '$premiovalor' WHERE Caixaid = '$caixaevid'";
            $salvarcaixaev = mysqli_query($conexao, $sqlcaixaev);
            $sqlapostador2 = "UPDATE apostadores SET apostou = '0', caixavr = '0' WHERE serialcontas = '$exserial'";
            $salvarapostador2 = mysqli_query($conexao, $sqlapostador2);
            echo "<P> Dinheiro depositado na sua conta, faça outra aposta</P><BR><HR><BR>";
        }
        ?>

        <p> Faça a sua aposta </p><br>
        <p> Escolha um número entre 1 e 100 </p>
        <form method="POST" action="c/requestLoterica.php" >
            <input type="number" class="campo" placeholder="Escolha um número" name="loto" onkeydown="return FilterInput(event)" onpaste="handlePaste(event)" required ><br><br>
            <?php echo "<input class=btn type=submit  $vrapostou value=Confirmar />"; ?>
        </form>
        <p>Valor da aposta: $ 3.000.000.000</p>
        <br>

        <br><p style="text-align: center; color: greenyellow;">Você só poderá fazer uma aposta por rodada(a cada 1 dia)</p><br>
        <p style="text-align: center; color: greenyellow;">Caso ganhe o dinheiro será automaticamente depositado na sua conta do RRBanK</p><br>
        <p style="text-align: center; color: greenyellow;">Saldo do prêmio da aposta é automaticamente retirado do caixa de eventos</p><br>
        <p style="text-align: center; color: greenyellow;">O número será sorteado automaticamente no fim do tempo</p><br>
    </div><br>
    <script>
        function FilterInput(event) {
            var keyCode = ('which' in event) ? event.which : event.keyCode;

            isNotWanted = (keyCode == 69 || keyCode == 101);
            return !isNotWanted;
        }
        ;

        function handlePaste(e) {
            var clipboardData, pastedData;

            // Get pasted data via clipboard API
            clipboardData = e.clipboardData || window.clipboardData;
            pastedData = clipboardData.getData('Text').toUpperCase();

            if (pastedData.indexOf('E') > -1) {
                //alert('found an E');
                e.stopPropagation();
                e.preventDefault();
            }
        }
        ;
    </script>
</body>
</html>
