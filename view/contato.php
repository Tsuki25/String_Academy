<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>String Games</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/icons/Site_Icone.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> 
    
    <link rel="stylesheet" href="css/estilosContato.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="css/formLogin.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php
        include_once ("pgGerais/cabecalho.php");//cabeçalho
        include_once ("pgGerais/login.php");//login
    ?>
    <section>
        <div class="contato">
            <h1>Nos deixe sua opinião :)</h1>
            <form class="formcontato">
                <input type="text" class="campoForm" placeholder="Digite seu Nome">
                <input type="email" class="campoForm" placeholder="Digite seu Email">
                <input type="text" class="campoForm" placeholder="Digite o Assunto">
                <textarea class="campoForm" placeholder="Digite sua Mensagem"></textarea>
                <input type="submit" class="botaoEnvio botaoEnviar" onclick="alert('Opinião enviada com sucesso!')">
            </form>
        </div>
    </section>
        <?php
            include_once("pgGerais/newsletter.php");//rodape
        ?>      
</body>
</html>
