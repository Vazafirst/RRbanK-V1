<?PHP
    require_once '../conexao/conexao.php';
    
            $tipo = $_POST['op'];
            $descricao = $_POST['descricao'];
            $sql = "insert into eventos (ev_tipo, descricao) values ('$tipo', '$descricao')";
            $salvar = mysqli_query($conexao, $sql);

            mysqli_close($conexao);
            header("Location: ../adm_eventos.php");
            