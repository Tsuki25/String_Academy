<?php
require_once '../model/VideoLoader.php';
$video_service = new VideoLoader("bd_vector_academy", "localhost", "root", "");
session_start();

// ------------------------- CADASTRAR VIDEOS -----------------------------------
if (isset($_POST['btn-cadastrar'])) {// VERIFICA SE A PESSOA CLICKOU NO BOTÃO ADICIONAR AULA
    //RECEBE OS VALORES DOS FORMULÁRIOS E ADICIONA-OS EM VARIAVEIS
    $titulo = addslashes($_POST['titulo']); //A FUNÇÃO ADDSLASHES PROTEJE O CODIGO CONTRA CODIGOS MALICIOSOS
    $url = addslashes($_POST['url']);
    $jogo = addslashes($_POST['jogo']);
    //VERIFICA SE TODOS OS CAMPOS FORAM PREENCHIDOS
    if (!empty($titulo) && !empty($url) && !empty($jogo)) {
        $res = $video_service->buscarVideo($url);
        if(!empty($res)){
            echo "Video já cadastrado";
        }else{
            $video_service->cadastrarVideos($titulo, $url, $jogo);
            header("Location: ../view/aulas.php");
        }
        echo "PREENCHA TODOS OS DADOS";
    }
}    
// ----------------------------------------------------------------------------------

// ------------------------- EDITAR VIDEOS -----------------------------------
if (isset($_POST['btn-editar'])) {// VERIFICA SE A PESSOA CLICKOU NO BOTÃO ADICIONAR AULA
    //RECEBE OS VALORES DOS FORMULÁRIOS E ADICIONA-OS EM VARIAVEIS
    $titulo = addslashes($_POST['titulo']); //A FUNÇÃO ADDSLASHES PROTEJE O CODIGO CONTRA CODIGOS MALICIOSOS
    $url = addslashes($_POST['url']);
    $jogo = addslashes($_POST['jogo']);
    $id_video = addslashes($_POST['id_video']);
    //VERIFICA SE TODOS OS CAMPOS FORAM PREENCHIDOS
    if (!empty($titulo) && !empty($url) && !empty($jogo)) {
        $res = $video_service->buscarVideo($url);
        if(!empty($res) && $res['id_video'] != $id_video){
            echo "ALTERAÇÃO DO VIDEO INDISPONIVEL, URL JÁ CADASTRADO";
        }else{
            $video_service->atualizarVideos($titulo, $url, $jogo, $id_video);
            header("Location: ../view/aulas.php");
        }
        echo "PREENCHA TODOS OS DADOS";
    }
}   
// ----------------------------------------------------------------------------------

