<?php

class Funcoes {

    public function base64($valor, $tipo) {
        switch ($tipo) {
            case 1: $rst = base64_encode($valor);
                break;
            case 2: $rst = base64_decode($valor);
                break;
        }
        return $rst;
    }

}
