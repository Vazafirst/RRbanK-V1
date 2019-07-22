<?php

if (isset($_SESSION["sessiontime"])) {
    if ($_SESSION["sessiontime"] < time()) {
        session_unset();
        echo "Sua sessão expirou, logue novamente";
        echo "<meta http-equiv='refresh' content='2.5;URL=http://rrbank.ifasthost.xyz/' />";
        //Redireciona para login
    } else {
        echo "Você está logado como: $logado";
        //Seta mais tempo 60 segundos
        $_SESSION["sessiontime"] = time() + 60*60;
    }
} else {
    session_unset();
    //Redireciona para login
}