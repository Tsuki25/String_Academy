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
                <form method="get" action="">
                    <label for="nome">Nome: </label><br/>
                    <input type="text" name="nome"/><br/>
                    <br/>
                    <label for="senha">Senha: </label><br/>
                    <input type="text" name="senha"/><br/>
                    <br/>
                    <label for="nick">Nick: </label><br/>
                    <input type="text" name="nick"/><br/>
                    <br/>
                    <label for="anoNasc">Ano de nascimento: </label><br/>
                    <input type="number" name="anoNasc" placeholder="4 Digitos"/><br/>
                    <br/>
                    <label for="email">Email: </label><br/>
                    <input type="text" name="email"/><br/>
                    <br/>
                    <label for="genero">Genêro: </label><br/>
                    <fieldset>
                        <input type="radio" name="genero" id="masc" value="homem"/>
                        <label for="masc" class="opcoesGenero">Masculino</label><br/>
                        <input type="radio" name="genero" id="fem" value="mulher"/>
                        <label for="fem" class="opcoesGenero">Feminino</label><br/>
                        <input type="radio" name="genero" id="outro" value="outro"/>
                        <label for="outro" class="opcoesGenero">Outro</label><br/>
                    </fieldset><br/>
                    <input type="submit" value="Cadastrar" id="cadastrar" class="btn-form"/>
                </form>
            </article>
            
            
           <!-- <article class="login">
                <p class="titulo">Entrar</p><br/>
                <form method="get" action="">
                    <label for="login">Login: </label><br/>
                    <input type="text" name="login"/><br/>
                    <br/>
                    <label for="senha">Senha: </label><br/>
                    <input type="text" name="senha"/>
                    <br/>
                    <input type="submit" value="Entrar" id="Entrar" class="btn-form"/>
                </form>
            </article>-->
        </section> 
        
        
        <?php
            include_once("pgGerais/newsletter.php");//rodape
        ?>
    </body>
</html>


