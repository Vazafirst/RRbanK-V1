<!DOCTYPE html>
<?php include "./includes/menu.php" ?>
<html>

    <?php
    require_once './conexao/conexao.php';

    $sql = "SELECT * FROM atts order by idatt DESC LIMIT 15";
    $result = mysqli_query($conexao, $sql);
    ?>

    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css" >

        <style>

            .conteudo{
                background-color: #222231;
                position: static;
                width: 90%;
                height: auto;
                min-height: 400px;
                max-height: 1995px;
                margin-left: 0px;
                align-content: center;
                align-items: center;
                text-align: center;
                display: block;
            }


            .atts{
                margin: 0 auto;
                border: solid #ff6600;
                padding: 0;
                width: auto;
                height: auto;
                max-width: 800px;
                display: block;
            }

        </style>
    </head>
    <body>
    <center>
        <br>
        <h1>Atualizações</h1>
        <hr><center><?php include_once './c/verificarOnline.php'; ?><br><br></center>
        <p> Bem vindo(a) a página de atualizações </p>
        <p> Fique informado sobre todas as mudanças que ocorrem no RRBanK </p><br>

        <div class="conteudo" id="conteudo" >

            <br><br><div class="atts">

                <?php
                while ($atts = mysqli_fetch_assoc($result)) {

                    $attdata = $atts['dia'];
                    $attdescricao = $atts['descricao'];

                    echo utf8_encode("<P style='text-align: center; color: #ff0000;'>" . $attdata . "</P><P style='text-align: center; color: #00ff00;'> " . $attdescricao . "</P><HR>");
                }
                ?>

            </div> <br><br>
        </div> <br>
    </center>
</body>
</html>
