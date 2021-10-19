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
        
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="icon" href="img/icons/Site_Icone.png"> 
        
        <title>String Academy</title>
    </head>
    <body>
        <?php
            include_once ("pgGerais/cabecalho.php");//cabeçalho
            include_once ("pgGerais/login.php");//login
        ?>
        <!-- ----------Banner-------------- -->
        <section class="hero">
            <h1>"Aqui a evolução acontece"</h1>
            <a class="btn" href="aulas.php">Saiba mais</a>
        </section>

        <div class="divisoria " id="primeiraDivisoria"> 
            <h3>Estude, Evolua e Divirta-se</h3>
            <hr id="risquinho" />
        </div>
        
        <!-- ---------- CONTEUDO -------------- -->
        <section class="conteudo ">
             <div class="espacamento"></div>
             
            <button class="card pgJogos">
                <a href="aulas.php"><img src="img/Academy.png" class="card-img-top" alt="Academy"></a>
            </button>
             
            <button class="card pgJogos" >
                <a href="campeonato.php"><img src="img/Torneio.png" class="card-img-top" alt="Torneios"></a>
            </button>

            <div class="espacamento"></div>
        </section>
        
        <section class="conteudoPT2">
            <!-- ------------------ACADEMY------------------------ -->
            <div class="itens" id="part1">
                <div class="divisoria">
                    <a href=""><h3 id="academy">Academy: Aprenda com os melhores</h3></a>
                    <hr/>
                </div>    
                <div class="texto">
                    <p>Na Vector Academy você terá a oportunidade de ter aulas sobre seus jogos favoritos, com especialistas e jogadores profissionais relacionados aos mais diversos aspectos do jogo. </p>
                </div> 
                <br/>
                <iframe width="600" height="500" src="https://www.youtube.com/embed/oDQcKJttn3Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <div></div>
            </div>
            
            <!-- ------------------Torneios------------------------ -->
            <div class="itens" id="part2">
                <div class="divisoria">
                    <a href=""><h3 id="torneios">Torneios: Dispute e Evolua</h3></a>
                    <hr/>
                </div>    
                <div class="texto">
                    <p>Os torneios são formas de incentivar a evolução de nossos jogadores, neles você disputa com diversos times para provar ser o melhor e levar o prêmio, enquanto isso evolui sua comunicação, trabalho em equipe e sente um gostinho do mundo dos e-sports. </p>
                </div> 
                <br/>
                <iframe width="600" height="500" src="https://www.youtube.com/embed/sE3UqyzKR30" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <div></div>
            </div>
            
                        <!-- ------------------Evolução------------------------ -->
            <div class="itens" id="part3">
                <div class="divisoria">
                    <a href=""><h3 id="evolucao">Sobre nós.</h3></a>
                    <hr/>
                </div>    
                <div class="texto">
                    <p> A String Academy é um projeto de amigos com o objetivo de disseminar o conhecimento relacionado ao mundo dos e-sports, com o objetivo de mostrar oportunidades e desenvolver o cenário competitivo nacional. </p>
                </div> 
                <br/>
                <img src="img/icons/logo_string.png"/>
                <div></div>
            </div>
        </section>    
        
        
        <?php
            include_once("pgGerais/newsletter.php");//rodape
        ?>
    </body>
</html>
