<?php
    require_once '../model/VideoLoader.php';
    $video_loader = new VideoLoader("bd_Vector_Academy", "localhost", "root", "");
?>
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
        <link href="css/pgAulas.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/estilos.css">
        
        <link rel="icon" href="img/icons/Site_Icone.png"> 
        
        <title>String Games</title>
    </head>
    <body>
        <?php
            include_once ("pgGerais/cabecalho.php");//cabeçalho
            include_once ("pgGerais/login.php");//login
            include_once "pgGerais/filtroJogos.php";
        ?>
        
        <!-- ESSE FILTRO É PARA SE TORNAR VARIAVEL DE ACORDO COM O JOGO  -->
        <section class="videos_filtros">
            <?php// include_once "pgGerais/filtroGeral.php"; ?>
            
            <article class="cadastro_aulas" id="form-aulas">
                <form method="post" action="../controller/video_controller.php">
                    <img src="img/fechar.png" alt="fechar" id="fechar" onclick="document.getElementById('form-aulas').style.display='none';document.getElementById('fechar').style.display='none';"/>
                    <h3 class><?php if(isset($res)){echo 'Editar Aula';}else {echo 'Adicionar Aula';} ?></h3> 
                    <hr>
                    <label for="titulo">Titulo: </label><br/>
                    <input type="text" name="titulo" value=" <?php if(isset($res)){echo $res['titulo'];} ?>"/><br/>
                    <br/>
                    <label for="url">URL: </label><br/>
                    <input type="text" name="url" placeholder="/X3V7yXiLe8A" value="<?php if(isset($res)){ echo $res['url'];}?>"/><br/>
                    <br/>
                    <label for="jogo">Jogo: </label><br/>
                    <fieldset>
                        <input type="radio" name="jogo" id="vlr" value="vlr" <?php if(isset($res) && $res['jogo'] == "vlr"){echo "CHECKED";} ?>/>
                        <label for="vlr" class="opcoesGenero">Valorant</label><br/>
                        <input type="radio" name="jogo" id="lol" value="lol" <?php if(isset($res) && $res['jogo'] == "lol"){echo "CHECKED";} ?>/>
                        <label for="lol" class="opcoesGenero">LoL</label><br/>
                        <input type="radio" name="jogo" id="lor" value="lor" <?php if(isset($res) && $res['jogo'] == "lor"){echo "CHECKED";} ?>/>
                        <label for="lor" class="opcoesGenero">LoR</label><br/>
                        <input type="radio" name="jogo" id="r6" value="r6" <?php if(isset($res) && $res['jogo'] == "r6"){echo "CHECKED";} ?>/>
                        <label for="r6" class="opcoesGenero">R6</label><br/>
                    </fieldset><br/>
                    <?php if(isset($res)){echo "<input type='hidden' value='$id' name='id_video'/>";}?>
                    <input name="<?php if(isset($res)){echo 'btn-editar';}else {echo 'btn-cadastrar';} ?>" type="submit" value="<?php if(isset($res)){echo 'Editar';}else {echo 'Cadastrar';} ?>" id="filtrar" class="btn-busca"/>
                </form>
            </article>

            <article class="video">
               <?php
                    $jogo_filtro = '';
                    if(isset($_GET['jogo_filtro'])) {//SE A PESSOA CLICKOU NO BOTÃO EDITAR
                        $jogo_filtro = addslashes($_GET['jogo_filtro']);//PEGA O VALOR PASSADO PELO BOTÃO EDITAR SELECIONADO
                    }

                    if (isset($_GET['pagina'])) {
                        $pagina = addslashes($_GET['pagina']);
                        $pg = $pagina;
                    } else {
                        $pg = 1;
                    }
                    
                    $video_loader->carregarVideos($jogo_filtro,9,$pg); //RECEBE OS VALORES DO BANCO DE DADOS PARA EXIBIR NA TELA 
               ?>
            </article>
        </section>
        
        <?php
            include_once("pgGerais/newsletter.php");//rodape
        ?>
    </body>
</html>
