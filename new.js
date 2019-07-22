function contador() {
// data informada
    valInput = $("#data").val();

    contar = setInterval(function () {
        // data atual
        data1 = new Date();
        // converte string em milisegundos
        data2 = Date.parse(new Date(valInput));

        diferenca = data2 - data1;

        // exibe a mensagem e para a repetição
        if (diferenca <= 0) {
            $("#contador").text('0');
            clearInterval(contar);
        } else {
            //dias  = Math.floor( diferenca / (1000*60*60*24) );
            //horas = Math.floor( diferenca / (1000*60*60) );
            //minutos  = Math.floor( diferenca / (1000*60) );
            segundos = Math.floor(diferenca / 1000);

            //dd = dias;
            //hh = horas - dias  * 24;
            //mm = minutos  - horas * 60;
            //ss = segundos  - minutos  * 60;

            $("#contador").text(
                    //dd + ' dias ' +
                    //hh + ' horas ' +
                    //mm + ' minutos ' +
                    //ss = ' segundos ' +
                    segundos + ' segundos');

        }
    }, 1000);
}