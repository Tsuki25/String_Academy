<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
              
        <link href="css/formLogin.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/styleCampeonato.css">     
        <link rel="icon" href="img/icons/Site_Icone.png">      
        <title>String Games</title>
    </head>
    <body>
        <?php
            include_once ("pgGerais/cabecalho.php");//cabeçalho
            include_once ("pgGerais/login.php");//login
        ?>

        <section class="row" style="height:300px;">
            <div class="page mx-auto ">      
                <div class="countdown-col col ">
                    <div class="time middle">
                        <span>
                            <div id="d">00</div>
                            Dias
                        </span>
                        <span>
                            <div id="h">00</div>
                            Horas
                        </span>
                        <span>
                            <div id="m">00</div>
                            Minutos
                        </span>
                        <span id="seconds">
                            <div id="s">00</div>
                            Segundos
                        </span>
                    </div>                           
                </div> 
            </div>
        </section>
        
        <section class="row">
            <div class="contato mx-auto p-1">
                <h1>Faça já sua inscrição</h1>
                <form action="" class="formcontato">
                    <input type="text" class="campoForm" placeholder="Nome Completo">
                    <input type="email" class="campoForm" placeholder="Email para contato">
                    <input type="text" class="campoForm" placeholder="Digite seu Nick">
                    <input type="submit" class="botaoEnvio botaoEnviar" onclick="alert('Inscrição realizada com sucesso')">
                </form>
                <h3><span>Premiações: </span><br><br> 1º Colocação: R$2000 <br><br> 2º Colocação: R$1000 <br><br> 3º Colocação: R$500</h3>
            </div>
        </section>
            
            <script src="javascript/countdown.js"></script>
        <?php
            include_once("pgGerais/newsletter.php");
        ?>
    </body>
</html>