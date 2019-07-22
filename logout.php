<?php
session_start();
session_destroy();

unset($_SESSION['login']);
unset($_SESSION['senha']);
unset($_SESSION["sessiontime"]);
unset($_COOKIE['login']);
unset($_COOKIE['senha']);
?>

<script language= "JavaScript" >
    location.href = "index.php";
</script>