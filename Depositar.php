<html>
    <head>
        <script>
            var i = 60;
            function contagemRegressiva()
            {
                i--;
                document.getElementById('cronometro').innerHTML = i + ' segundos';
                if(i == 0)
    		{
		    i = 60;
		}
	    }
	    setInterval("contagemRegressiva()", 1000);
	</script>
    </head>
    <body>
    	<div id="cronometro">
            30 segundos
        </div>
    </body>
</html>