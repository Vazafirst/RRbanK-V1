<?PHP

require_once '../conexao/conexao.php';

$idevento = $_POST['id'];
$sql = "UPDATE eventos SET acabou = '1' WHERE evid = '$idevento'";
$salvar = mysqli_query($conexao, $sql);

$sql2 = "DELETE FROM eventos WHERE acabou = '1'";
$apagar = mysqli_query($conexao, $sql2);

mysqli_close($conexao);


            