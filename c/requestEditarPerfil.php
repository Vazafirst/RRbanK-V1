<?php include "./includes/menu.php";
?>
<?php
        require_once "./conexao.php";

        $sql = "SELECT * FROM contas WHERE login = '$logado' LIMIT 1";
        $result = mysqli_query($conexao, $sql);
        $resultado = mysqli_fetch_assoc($result);
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css" >
        <link rel="stylesheet" type="text/css" href="css/cad.css">
        <link rel="stylesheet" type="text/css" href="css/perfil.css">
    </head>
    <body>
        <div class="container">   
            <section>
                <center>
                    <h1>Editar dados</h1>
                    <hr><br><br>
                    Mudança de foto de perfil está desativada<br>
                    para correção de bugs
                    <form method="post" action="requestp.php">
                    <br><br>
                    <div class="experfil" > 
                        <img class="ftperfil" src="./imagens/perfil.png" >
                        <h2 class="nick"> <?php echo $logado; ?> </h2>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login não pode ser alterado
                        <br>
                        <output class="nome" >
                            Nome: <input style="color: black;" type="text" class="campoep" name="name" value="" />
                        </output><br>
                        <output class="nicknorr" >
                            Nick no RR: <input style="color: black;" class="campoep" type="text" name="rrnick" value="" />
                        </output><br>
                        <output class="email" >
                            Email: <input style="color: black;" type="email" class="campoep" name="email" value="" />
                        </output><br>
                    </div>
                    <br>
                    <input type="submit" value="Confirmar" class="btn_editar">
                    </form>
                </center>

            </section>       
        </div>
    </body>
</html>
