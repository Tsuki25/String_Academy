<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        
        <link href="css/pgCadastro.css" rel="stylesheet" type="text/css"/>
        <link href="css/formLogin.css" rel="stylesheet" type="text/css"/>
        
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="icon" href="img/icons/Site_Icone.png"> 
        
        <title>String Games</title>
    </head>
    <body>
        <?php
            include_once ("pgGerais/cabecalho.php");//cabeçalho
            include_once ("pgGerais/login.php");//login
        ?>
        
        <section class="content">
            <article class="cadastro">
                <p class="titulo">Cadastrar-se</p><br/>
                <form method="POST" action="../controller/user_controller.php">
                    <label for="nome">Nome: </label><br/>
                    <input type="text" name="nome"/><br/>
                    <br/>
                    <label for="senha">Senha: </label><br/>
                    <input type="password" name="senha"/><br/>
                    <br/>
                    <label for="nick">Nick: </label><br/>
                    <input type="text" name="nick"/><br/>
                    <br/>
                    <label for="anoNasc">Ano de nascimento: </label><br/>
                    <input type="number" name="anoNasc" size="4" max="2008" min="1940"/><br/>
                    <br/>
                    <label for="email">Email: </label><br/>
                    <input type="email" name="email"/><br/>
                    <br/>
                    <label for="genero">Genêro: </label><br/>
                    <fieldset>
                        <input type="radio" name="genero" id="masc" value="masculino"/>
                        <label for="masc" class="opcoesGenero">Masculino</label><br/>
                        <input type="radio" name="genero" id="fem" value="feminino"/>
                        <label for="fem" class="opcoesGenero">Feminino</label><br/>
                        <input type="radio" name="genero" id="outro" value="outro"/>
                        <label for="outro" class="opcoesGenero">Outro</label><br/>
                    </fieldset><br/>
                    <input type="submit" value="Cadastrar" id="cadastrar" name="btn-cadastro" class="btn-form"/>
                </form>
            </article>
           
        </section>
        
        
        <?php
            include_once("pgGerais/newsletter.php");//rodape
        ?>
    </body>
</html>


