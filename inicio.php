<?php include "./includes/menu.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css" >
        <link rel="stylesheet" type="text/css" href="css/inicio.css">
        <?php
        include_once "./conexao/conexao.php"; // conexão com o banco de dados
        include_once './src/dao/eventoDao.php'; // querys para exibir os eventos
        include_once './c/funcoes.php';
        $caixaemer = 1; // Pega id do caixa emergencial
        $caixaev = 2; // Pega id do caixa de eventos

        date_default_timezone_set('America/Sao_Paulo'); // Define a hora global como horário brasileiro
        $diahj = date("Y-m-d H:i:s"); // Pega a data atual
        // pega os dados geral da conta dos usuarios
        $sql = "SELECT * FROM contas WHERE serial = '$exserial' LIMIT 1";
        $result = mysqli_query($conexao, $sql);
        $resultado = mysqli_fetch_assoc($result);
        $saldo = $resultado['dinheiro'];
        $datalimit = $resultado['datalimite'];
        $verificarconta = $resultado['vr'];
        $diacad = $resultado['datacadastro'];
        $dinheiroup = $resultado['dinheiroup'];
        $vrtiporendimento = $resultado['tipo'];

        // pega dados do caixa do banco   
        $sql1 = "SELECT dinheiro FROM caixa WHERE CaixaID = '$caixaev' LIMIT 1";
        $resultcx = mysqli_query($conexao, $sql1);
        $eventors = mysqli_fetch_assoc($resultcx);
        $evento = $eventors['dinheiro'];
        $sql2 = "SELECT dinheiro FROM caixa WHERE CaixaID = '$caixaemer' LIMIT 1";
        $resultem = mysqli_query($conexao, $sql2);
        $emergencialrs = mysqli_fetch_assoc($resultem);
        $emergencial = $emergencialrs['dinheiro'];
        //
        // pega dados da conta bancária do usuario    
        $sql3 = "SELECT * FROM banco WHERE serialcontas = '$exserial'";
        $resultbanco = mysqli_query($conexao, $sql3);
        $resultadobanco = mysqli_fetch_assoc($resultbanco);
        $contabanco = $resultadobanco['serialcontas'];
        $saldobanco = $resultadobanco['dinheiroup'];
        $idrrbanco = $resultadobanco['RRID'];

        //
        // Caso o usúario seja novo, ele criará a conta nas tabelas abaixo
        if (empty($contabanco)) {
            $sql4 = "INSERT INTO banco (serialcontas) VALUES ('$exserial')";
            $salvar = mysqli_query($conexao, $sql4);
            $sql5 = "INSERT INTO saque (serialcontas) VALUES ('$exserial')";
            $salvar2 = mysqli_query($conexao, $sql5);
            $sql6 = "INSERT INTO deposito (serialcontas) VALUES ('$exserial')";
            $salvar3 = mysqli_query($conexao, $sql6);
        }
        //
        $sql4 = "SELECT * FROM loterica WHERE serialcontas = '$exserial'";
        $resultloterica = mysqli_query($conexao, $sql4);
        $resultadoloterica = mysqli_fetch_assoc($resultloterica);
        $contaloterica = $resultadoloterica['serialcontas'];

        if (empty($contaloterica)) {
            $sql14 = "INSERT INTO apostadores (serialcontas) VALUES ('$exserial')";
            $salvar14 = mysqli_query($conexao, $sql14);
            $sql15 = "INSERT INTO apostadoresrs (serialcontas) VALUES ('$exserial')";
            $salvar15 = mysqli_query($conexao, $sql15);
            $sql16 = "INSERT INTO lotericars (serialcontas) VALUES ('$exserial')";
            $salvar16 = mysqli_query($conexao, $sql16);
            $sql17 = "INSERT INTO loterica (serialcontas) VALUES ('$exserial')";
            $salvar17 = mysqli_query($conexao, $sql17);
            $data = date('Y/m/d H:i:s', strtotime("+1 Hours", strtotime($diahj)));
            $sqldata = "UPDATE loterica SET dataresult = '$data' WHERE serialcontas = '$exserial'";
            $salvardata = mysqli_query($conexao, $sqldata);
            $sorteiosql2 = "UPDATE loterica SET valorlot = '200' WHERE serialcontas = '$exserial'";
            $salvarsorteio2 = mysqli_query($conexao, $sorteiosql2);
        }

        if ($vrtiporendimento == 1) {
            $data = date('Y/m/d H:i:s', strtotime("+1 days", strtotime($diahj)));
            $porc = 1 / 100; // Porcentagem de rendimento
            $valor = ($porc * $saldo); // Multiplica a porcentagem pelo dinheiro atual
        } else {
            $data = date('Y/m/d H:i:s', strtotime("+7 days", strtotime($diahj)));
            $porc = 10 / 100; // Porcentagem de rendimento
            $valor = ($porc * $saldo); // Multiplica a porcentagem pelo dinheiro atual
        }

        // Compara a data limite para os juros do usúarios serem adicionados, Se a data limite for menor que hoje, a data ganhará +7 dias e os juros serão adicionado na conta do cliente
        if ($datalimit < $diahj) {
            $sqlganhos = "UPDATE contas SET dinheiro = dinheiro + '$saldobanco' WHERE serial = '$exserial'";
            $salvarganhos = mysqli_query($conexao, $sqlganhos);
            $sqldata = "UPDATE contas SET datalimite = '$data' WHERE serial = '$exserial'";
            $salvardata = mysqli_query($conexao, $sqldata);
        }
        // Adicionando link para o perfil na váriavel
        $perfilvr = "<a id='terms' class='terms' href='https://m.rivalregions.com/#slide/profile/812857693001919?1562921343360'> Avicii◢◤ </a>";
        //
        // Verifica se a conta já foi verifica
        if ($verificarconta > 0) {
            $exvr = "<P style='text-align: center; color: greenyellow;'>Parece que sua conta ainda não foi verificada<BR> por favor antes de realizar saques e depósitos envie o seguinte número<P style='text-align: center; color: red;'>$verificarconta</P><P style='text-align: center; color: greenyellow;'> para o privado do </P><P style='text-align: center; color: red;'>$perfilvr</P><P style='text-align: center; color: greenyellow;'> no RR<br> e aguarde a confirmação</P>";
        } else {
            $exvr = "<P style='text-align: center; color: greenyellow;'>Bem vindo(a) ao RRBank<BR> Sua nova forma de lucrar começou</P>";
        }
        //
        // Quando a conta tiver sido verificada o ID do RR será adicionado em todas as tabelas necessárias
        if (empty($idrrbanco)) {
            $sql4 = "UPDATE banco SET RRID = '$vrrrid' WHERE serialcontas = '$exserial'";
            $salvar = mysqli_query($conexao, $sql4);
            $sql5 = "UPDATE saque SET RRID = '$vrrrid' WHERE serialcontas = '$exserial'";
            $salvar2 = mysqli_query($conexao, $sql5);
            $sql6 = "UPDATE deposito SET RRID = '$vrrrid' WHERE serialcontas = '$exserial'";
            $salvar3 = mysqli_query($conexao, $sql6);
        }
        //
        // Pega os dados das contas para fazer o rank
        $sqlrank = "SELECT * FROM contas order by dinheiro DESC LIMIT 10";
        $resultrank = mysqli_query($conexao, $sqlrank);
        //
        // Exibe o número da ultima aposta da loterica
        $sqlexaposta = "SELECT * FROM lotericars WHERE serialcontas = '$exserial'";
        $resultex = mysqli_query($conexao, $sqlexaposta);
        $resultadoex = mysqli_fetch_assoc($resultex);
        $valorlot2 = $resultadoex['valorlot'];
        // 
        // Pega dados da tabela de saque
        $sqlSaque = "SELECT * FROM saque WHERE serialcontas = '$exserial'";
        $resultSaque = mysqli_query($conexao, $sqlSaque);
        $resultadoSaque = mysqli_fetch_assoc($resultSaque);
        $verificarSaque = $resultadoSaque['verificar'];
        $vrsaque = $resultadoSaque['saque'];
        //
        // Pega dados da tabela de depósito
        $sqlDeposito = "SELECT * FROM deposito WHERE serialcontas = '$exserial'";
        $resultDeposito = mysqli_query($conexao, $sqlDeposito);
        $resultadoDeposito = mysqli_fetch_assoc($resultDeposito);
        $verificarDeposito = $resultadoDeposito['verificar'];
        $vrdeposito = $resultadoDeposito['deposito'];
        //
        // Atualiza o saldo futuro da conta
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
        //
        ?>
    <body>
        <div class="container">   
            <center>
                <h1>Inicio</h1>
                <hr>
                <?php include_once './c/verificarOnline.php'; ?><br><br>
                <div class="warn2" id="warn2" >
                    <?php echo $exvr; ?>   
                </div><br><br><br>
                <div class="exloterica">
                    <p class="idinicio">Loterica</p><br>
                    <p style='text-align: center; color: #00ff00;'>Último número sorteado</p><br>
                    <div class="apostaresult">
                        <?php echo "<P class=numerosorteio>" . $valorlot2 . "</P>" ?>
                    </div><br>
                    <p class="infobanco_inicio"><a href="./loterica.php">Clique aqui</a> e faça uma aposta</p><br>
                </div><br><br>
                <div class="exeventos"><p class="infoinicio" >
                    <p class="idinicio">Eventos ativos</p><br><br>
                    <?php
                    if (mysqli_num_rows($result2) != 0) {
                        
                    } else {
                        echo "<P style='text-align: center; color: #00ff00;'> Não há nenhum evento ativo no momento</P>";
                    }
                    while ($evtipo2 = mysqli_fetch_assoc($result2)) {
                        $eventotipo2 = $tipoev2;
                        $acabou2 = $evtipo2['acabou'];
                        $descricao2 = $evtipo2['descricao'];
                        if ($acabou2 == 0) {
                            echo "<P style='text-align: center; color: #00ff00;'>" . $descricao2 . "</P>";
                        }
                    }
                    ?>
                    <BR><br><p>Veja a lista completa de eventos</p><a href="./eventos.php">aqui</a>
                </div>
                <br><br>
                <div class="exsaldo" id="banco" >
                    <p class="idinicio">Banco</p><br>
                    <output class="saldo" ><?php
                        echo "Saldo báncario atual: <br><br>";
                        $saldo1 = number_format($saldo, 0, ",", ".");
                        $saldo2 = number_format($saldo, 0, ",", ".");
                        if ($saldo <= 0) {
                            $saldo4 = $saldo2;
                        } else {
                            $saldo4 = $saldo1;
                        }
                        echo $saldo4;
                        ?>
                    </output>
                    <?php
                    if ($saldo <= 0) {
                        echo "<br><br>Realize um depósito para começar a lucrar";
                    } else {
                        $dia_hora_atual = strtotime(date("Y-m-d H:i:s")); //aqui o dia atual

                        $dia_hora_evento = strtotime(date($datalimit)); // aqui o dia que o vip vai acaba
#Achamos a diferença entre as datas...
                        $diferenca = $dia_hora_evento - $dia_hora_atual;
#Fazemos a contagem...
                        $dias = intval($diferenca / 86400);

                        $marcador = $diferenca % 86400;

                        $hora = intval($marcador / 3600);

                        $marcador = $marcador % 3600;

                        $minuto = intval($marcador / 60);


                        if ($vrtiporendimento == 1) {
                            echo "<P style='text-align: center; color: #ffbd1f;'> Proxíma atualização em:<BR> $hora hora(s) e $minuto minutos</P>";
                        } else {
                            echo "<P style='text-align: center; color: #ffbd1f;'> Proxíma atualização em:<BR> $dias dia(s) e $hora hora(s)</P>";
                        }
                    }
                    ?>
                    <br><p class="infobanco_inicio">  Para mais detalhes visite a aba <a href="./banco.php" id="banco">banco</a></p>
                </div><br>
                <div class="excaixa"><p class="infocaixa" >
                    <p class="idinicio">Caixa 2</p><br>
                    <p class="caixainicio">Saldo no caixa de eventos:</p><br>
                    <?php
                    $evento1 = number_format($evento, 0, ",", ".");
                    echo "<p class=evsaldo>$evento1<br></p>"
                    ?>
                    <br><p class="caixainicio">Saldo no caixa emergencial:</p><br>
                    <?php
                    $emergencial1 = number_format($emergencial, 0, ",", ".");
                    echo "<p class=evsaldo>$emergencial1<br></p>"
                    ?>
                    <br><p class="infobanco_inicio">  Faça uma doação para o caixa <a href="./caixa.php" >aqui</a></p>
                </div><br>
                <div class="exrank">
                    <p class="idinicio">Rank</p><br>
                    <p class="caixainicio">Usúarios com mais dinheiro no RRBanK</p><br>
                    <?php
                    while ($rank = mysqli_fetch_assoc($resultrank)) {

                        $ranklogin = $rank['login'];
                        $rankdimdim = $rank['dinheiro'];
                        $rankvr = $rank['vr'];
                        $rankex = number_format($rankdimdim, 0, ",", ".");

                        if ($rankvr == 0) {
                            echo "<P style='text-align: center; color: #00ff00;'>" . $ranklogin . " |  $" . $rankex . "</P>";
                        }
                    }
                    ?>
                </div>  
                <p>Somente contas verificadas aparecem no rank</p><br>
            </center>   
        </div><br><br>
    </div>
</body>
</html>
