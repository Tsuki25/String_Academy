<?php
include_once 'connection.php';

if(empty($_POST['titulo']) || empty($_POST['url']) || empty($_POST['jogo'])){//Verifica se o formulário foi preenchido corretamente
    header('Location: index.php');//Redireciona pro header
    exit();
}

// Recebe os valores do form
$titulo = filter_input(INPUT_POST, 'titulo');
$url = filter_input(INPUT_POST, 'url');
$jogo = filter_input(INPUT_POST, 'jogo');

// CADASTRA NO BANCO DE DADOS
$insert_video = "INSERT INTO Video_Aulas(id_video, titulo, url, jogo) VALUES(default, '$titulo', '$url', '$jogo')";
$result_insert_video = mysqli_query($conexao, $insert_video);

//QUANDO CADASTRAR VOLTA PARA A GUIA INICIAL
if(mysqli_insert_id($conexao)){
    header("Location: ../view/aulas.php");
}else{
     header("Location: ../view/aulas.php");
}
 /*   
    //PEGA OS VIDEOS DO BANCO E CARREGA NA PAGINA
    function loadVideos($jogo){
        include 'connection.php';

        //PARA CADA CASO OS VIDEOS EXIBIDOS NA TELA E SEUS RESPECTIVOS TITULOS SÃO MODIFICADOS
        if ($jogo != ''){
            $exibe_video = "SELECT titulo, url FROM Video_Aulas WHERE jogo = '$jogo'";
            $result_exibe_video = mysqli_query($conexao, $exibe_video);

            while ($row_video = mysqli_fetch_assoc($result_exibe_video)) {
                $titulo = $row_video['titulo'];
                $video = $row_video ['url'];
                echo "<div class='video_aulas'>
                    <iframe width='425' height='250' src='https://www.youtube.com/embed/$video' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                    <h5>$titulo</h5>
                </div>";
            }
        }else{
            $exibe_video = "SELECT titulo, url FROM Video_Aulas";
            $result_exibe_video = mysqli_query($conexao, $exibe_video);

            while ($row_video = mysqli_fetch_assoc($result_exibe_video)) {
                $titulo = $row_video['titulo'];
                $video = $row_video ['url'];
                echo "<div class='video_aulas'>
                    <iframe width='425' height='250' src='https://www.youtube.com/embed/$video' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                    <h5>$titulo</h5>
                </div>";
            }  
        }
    }*/
    