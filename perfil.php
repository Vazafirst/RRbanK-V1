<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css" >
        <link rel="stylesheet" type="text/css" href="css/perfil.css">
    </head>
    <header> <?php include "./includes/menu.php"; ?> </header>
    <?php
    require_once "./conexao/conexao.php";

    $sql = "SELECT * FROM contas WHERE login = '$logado' LIMIT 1";
    $result = mysqli_query($conexao, $sql);
    $resultado = mysqli_fetch_assoc($result);
    ?>
    <body>  
            <center>
                <br>
                <h1>Perfil</h1>
                <hr><center><?php include_once './c/verificarOnline.php'; ?><br><br></center>
                <h2>Página em construção</h2>
                
        <!--        <br><br></center>
            <div class="container"> 
                <div class="experfil" > 
                    <div class="div_ftperfil" >
                        <img class="ftperfil" src="./imagens/perfil.png" >
                    </div>
                    <div class="div_nick" ><h2 class="nick"><?php echo $logado; ?> </h2></div>
                    <br>
                    <div class="div_nicknorr" >
                        <p class="nicknorr" >
                            Nick no RR: <input id="newnicknorr" class="ed_nicknorr" type="text" name="nicknorreditar"/><?php echo $resultado['nomenorr']; ?></p></div>
                    <br>
                    <div class="div_email" >
                        <p class="email" >
                            Email: <input id="newemail" class="ed_email" type="text" name="emaileditar"/><?php echo $resultado['email'];?>
                        </p></div><br>

                </div>
                <br>
        </div>
                    <input id="editar" type="button" value="Editar" class="btn_editar">
                    <input id="confirmar" type="submit" value="Confirmar" class="btn_confirmar">
        <script>
        var btn = document.getElementById('editar');
        var btn1 = document.getElementById('confirmar');
        var input = document.getElementById('newnicknorr');
        var input1 = document.getElementById('newemail');

        btn.addEventListener('click', function () {
            input.style.display = 'block';
            input1.style.display = 'block';
            btn.style.display = 'none';
            btn1.style.display = 'block';
        });

    </script> !-->
    </body>
</html>
