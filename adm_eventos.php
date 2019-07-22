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
        <style>

            .endevent{
                background-color: #00ffff;
                color: black;
                position: absolute;
                top: 400px;
                left: 430px;
                width: 500px;
                height: 200px;
                display: none;
            }
            
            .newevent{
                background-color: #00ffff;
                color: black;
                position: absolute;
                top: 400px;
                left: 430px;
                width: 500px;
                height: 200px;
                display: none;
            }

            .bnt_adcev{
                padding: 5px;
                width: 50px;
                background-color: red;
                border: 1px red solid;
            }


        </style>
    </head>
    <header> <?php include_once './includes/menu.php'; 
    if($acessovr < 2){
      echo "<script language='JavaScript'>
          		alert('Error: Você não tem permissão para acessar essa página');
          		window.location.href='./inicio.php'
         		 </script>";
}
?> </header>
    <body> 
        <br><br>
        <h1 class="titulo" style="text-align: center">Eventos</h1>
        <hr/><br/><br/>
        <p style="text-align: center">
            Área de administração de eventos<br/></p> 
        <div class="exevento"> <br>
            <h2 class="eventos" >Eventos ativos</h2><br>
            <input type="button" class="bnt_adcev" id="btn_new" value="+"/>
            <input type="button" class="bnt_adcev" id="btn_end" value="X"/><br><br>
            <div class="conteudo" id="conteudo" >
                <p class="evtrabalho" ><h2>| TRABALHO |</h2></p><br>
                <form method="post" action="c_adm/requestEndEvent.php">    
                    <div class="trab">
                        <?php
                        if (mysqli_num_rows($result2) != 0) {
                            
                        } else {
                            echo "Não há nenhum evento ativo no momento";
                        }
                        while ($evtipo2 = mysqli_fetch_assoc($result2)) {
                            $eventotipo2 = $tipoev2;
                            $evid = $evtipo2 ['evid'];
                            $acabou2 = $evtipo2['acabou'];
                            $descricao2 = $evtipo2['descricao'];
                            if ($acabou2 == 0) {
                                ?><p><?php
                                    echo $evid . " | ";
                                    echo $descricao2;
                                }
                            }
                            ?></p>

                    </div><br>
                </form>
                <hr/>
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
                            echo "<P>" . $descricao3 . "</P>";
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
                            echo "<P>" . $descricao . "</P>";
                        }
                    }
                    ?>
                </div><br/><hr/><br/>
            </div>
        </div> 
        <div class="newevent" id="new">
            <form method="POST" action="c_adm/requestNewEvent.php">
                <b><center><br>
                        Tipo de evento<br>
                        <input type="radio" name="op" value="1" class="bnt_evs" /> Donate<br>
                        <input type="radio" name="op" value="2" class="bnt_evs" /> Work<br>
                        <input type="radio" name="op" value="3" class="bnt_evs" /> War<br>
                        <input type="radio" name="op" value="4" class="bnt_evs" /> Other<br>

                        Descrição:
                        <input type="text" name="descricao" /><br>
                        <input type="submit" value="Confirmar" class="confirmar_bnt"/>
                    </center> </b>
            </form>
        </div>          
        <div class=endevent" id="end">
            <form method="POST" action="c_adm/requestEndEvent.php">
                <b><center><br>
                        <p style="color: red;" >ENCERRAR EVENTO</p>
                        <p>ID Do Evento</p><br>
                        <input type="number" name="id" /><br>
                        <input type="submit" value="Confirmar" class="confirmar_bnt"/>
                    </center> </b>
            </form>
        </div>          
    </div>       
    <script>
        var btn = document.getElementById('btn_new');
        var div = document.getElementById('new');

        btn.addEventListener('click', function () {
            div.style.display = 'block';
        });
    </script>
    <script>
        var bnt = document.getElementById('btn_end');
        var dv = document.getElementById('end');

        bnt.addEventListener('click', function () {
            dv.style.display = 'block';
        });
    </script>

</body>
</html>
