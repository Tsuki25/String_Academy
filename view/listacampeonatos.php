<?php
    require_once '../model/CampLoader.php';
    $p = new CampLoader("bd_Vector_Academy", "localhost", "root", "");

?>
<?php //PEGAR DADOS PARA A ATUALIZAÇÃO --> add 03/11
    if(isset($_GET['campeonato']) && !empty($_GET['campeonato'])){
        $id = addslashes($_GET['campeonato']);
        $res = $p->buscarCampById($id);
    }
?>
        
<?php //EXCLUSÃO DE AULAS --> add 03/11
    if(isset($_GET['excluir']) && !empty($_GET['excluir'])){
        $id = addslashes($_GET['excluir']);
        $res = $p->excluirCampeonato($id);
        header('Location: listacampeonatos.php');
    }
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
        <link rel="stylesheet" href="css/listacampeonatos.css">
        <link rel="stylesheet" type="text/css" href="css/stylecard.css">
           
        <link rel="icon" href="img/icons/Site_Icone.png">      
        <title>String Games</title>
    </head>
    <body>
        <?php
            include_once ("pgGerais/cabecalho.php");//cabeçalho
            include_once ("pgGerais/login.php");//login 

        ?>
        <div class="escolha_jogos">
            <nav class="jogos">
                <li><a href="listacampeonatos.php?jogo_filtro=vlr"><img src="img/VLR_icon.png" alt="Valorant"/><span>VLR</span></a></li>
                <li><a href="listacampeonatos.php?jogo_filtro=lol"><img src="img/LOL_icon.png" alt="LeagueOfLegends"/><span>LOL</span></a></li>
                <li><a href="listacampeonatos.php?jogo_filtro=lor"><img src="img/LOR_icon.png" alt="LegendsOfRuneterra"/><span>LOR</span></a></li>
                <li> <a href="listacampeonatos.php?jogo_filtro=r6"><img src="img/R6_icon.png" alt="RainbowSix"/><span>RB6</span></a></li>
                <!--<li id="filter" onclick="document.getElementById('filtro').style.display='flex';document.getElementById('fechar').style.display='block';"><a><img src="img/filter.png" alt="filter"/></a></li> -->
            </nav>          
        </div>         
        <div class="add_aula"><a><img src="img/adicionar.png" alt="add" id="add" onclick="document.getElementById('form-aulas').style.display='flex';document.getElementById('fechar2').style.display='block';"/></a><h4>Adicionar Campeonato</h4></div>
     
        <section class="videos_filtros">
        <article class="cadastro_aulas" id="form-aulas">
                <form method="post" enctype="multipart/form-data" action="../controller/camp_controller.php">
                    <a><img src="img/fechar.png" alt="fechar" id="fechar2" onclick="document.getElementById('form-aulas').style.display='none';document.getElementById('fechar2').style.display='none';"/></a>
                    <h3 class>Adicionar Campeonato</h3> 
                    <hr>
                    <label for="imagem">Imagem do Campeonato - Click aqui</label>
                    <input type="file" name="foto" class="hidden" style="display: none" id="imagem"><br>
                    <label for="titulo">Titulo: </label><br>
                    <input type="text" name="titulo"/><br>              
                    <label for="premio">Premio: </label><br>
                    <input type="text" name="premio" placeholder="R$"/><br>
                    <label for="descricao">Descrição: </label><br>
                    <input type="text" name="descricao" placeholder="Digite uma Descrição"><br>
                    <label for="jogo">Jogo: </label><br>
                    <fieldset>
                        <input type="radio" name="jogo" id="vlr" value="vlr"/>
                        <label for="vlr" class="opcoesGenero">Valorant</label><br/>
                        <input type="radio" name="jogo" id="lol" value="lol"/>
                        <label for="lol" class="opcoesGenero">LoL</label><br/>
                        <input type="radio" name="jogo" id="lor" value="lor"/>
                        <label for="lor" class="opcoesGenero">LoR</label><br/>
                        <input type="radio" name="jogo" id="r6" value="r6"/>
                        <label for="r6" class="opcoesGenero">R6</label><br/>
                    </fieldset>

                    <?php if(isset($res)){echo "<input type='hidden' value='$id' name='id_campeonato'/>";}?>
                    <input name="<?php if(isset($res)){echo 'btn-editar';}else {echo 'btn-cadastrar';} ?>" type="submit" value="<?php if(isset($res)){echo 'Editar';}else {echo 'Cadastrar';} ?>" id="filtrar" class="btn-busca"/>
                </form>
            </article>
        </section>
        <section>
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
                
                $p->carregarCampeonato($jogo_filtro,9,$pg); //RECEBE OS VALORES DO BANCO DE DADOS PARA EXIBIR NA TELA 
        ?>
        </section>
        <?php
        if (isset($_SESSION['adm'])) {
        if ($_SESSION['adm'] == true) {//VERIFICA SE A PESSOA É UM ADMINISTRADOR E SE ESTÁ LOGADA
            echo " <style type='text/css'>
                        .add_aula {
                            display:flex;
                        }
                    </style>";
            if(isset($_GET['video']) && !empty($_GET['video'])){ //add --> 03/11
                echo "
                    <style type='text/css'>
                        #form-aulas {
                            display:flex;
                        }
                        #fechar{
                            display: block;
                        }
                    </style>";
            }
            } else {
                echo " <style type='text/css'>
                        .add_aula {
                            display:none;
                        }
                        </style>";
            }
            } else {
                echo " <style type='text/css'>
                            .add_aula {
                                display:none;
                            }
                        </style>";
            }
        ?>

        <?php
            include_once("pgGerais/newsletter.php");
        ?>
    </body>
</html>