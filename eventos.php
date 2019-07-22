<?php include_once './src/dao/eventoDao.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Eventos</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/evento.css">
    </head>
    <header> <?php include_once './includes/menu.php'; ?> </header>
    <body> 
        <br><br>
        <h1 class="titulo" style="text-align: center">Eventos</h1>
    <hr/><center><?php include_once './c/verificarOnline.php'; ?><br><br></center>
        <p style="text-align: center">
            Participe de eventos e receba prêmios no RR<br/></p> 
        <div class="exevento"> <br>
            <h2 class="eventos" >Eventos ativos</h2><br>
            <div class="conteudo" id="conteudo" >
                <p class="evtrabalho" ><h2>| TRABALHO |</h2></p><br>
                <div class="trab">
                    <?php 
                    if (mysqli_num_rows($result2) != 0) {
                        
                    } else {
                        echo "Não há nenhum evento ativo no momento";
                    }
                    while ($evtipo2 = mysqli_fetch_assoc($result2)) {
                        $eventotipo2 = $tipoev2;
                        $acabou2 = $evtipo2['acabou'];
                        $descricao2 = $evtipo2['descricao'];
                        if ($acabou2 == 0) {
                            echo "<P>" . $descricao2 . "</P><HR>";
                        }
                    }
                    ?>
                </div><br><hr/>
                <p class="evguerra" ><h2>| GUERRA |</h2></p><br>
                <div class="war">
                    <?php 
                    if (mysqli_num_rows($result3) != 0) {
                        
                    } else {
                        echo "Não há nenhum evento ativo no momento";
                    }
                    while ($evtipo3 = mysqli_fetch_assoc($result3)) {
                        $eventotipo3 = $tipoev3;
                        $acabou3 = $evtipo3['acabou'];
                        $descricao3 = $evtipo3['descricao'];
                        if ($acabou3 == 0) {
                            echo "<P>" . $descricao3 . "</P><HR>";
                        }
                    }
                    ?>
                </div><br><hr/>
                <p class="evdoacoes" ><h2>| DOAÇÕES |</h2></p><br>
                <div class="donate">
                    <?php 
                    if (mysqli_num_rows($result) != 0) {
                        
                    } else {
                        echo "Não há nenhum evento ativo no momento";
                    }
                    while ($evtipo = mysqli_fetch_assoc($result)) {
                        $eventotipo = $tipoev;
                        $acabou = $evtipo['acabou'];
                        $descricao = $evtipo['descricao'];
                        if ($acabou == 0) {
                            echo "<P>" . $descricao . "</P><HR>";
                        }
                    }
                    ?>
                </div><br/><hr/><br/>
            </div>
        </div> 
    </body>
</html>
