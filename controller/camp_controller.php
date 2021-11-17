<?php
require_once '../model/CampLoader.php';
$camp_service = new CampLoader("bd_vector_academy", "localhost", "root", "");
session_start();

// ------------------------- CADASTRAR VIDEOS -----------------------------------
if (isset($_POST['btn-cadastrar'])) {// VERIFICA SE A PESSOA CLICKOU NO BOTÃO ADICIONAR AULA
    //RECEBE OS VALORES DOS FORMULÁRIOS E ADICIONA-OS EM VARIAVEIS
    $titulo = addslashes($_POST['titulo']); //A FUNÇÃO ADDSLASHES PROTEJE O CODIGO CONTRA CODIGOS MALICIOSOS
    $premio = addslashes($_POST['premio']);
    $descricao = addslashes($_POST['descricao']);
    $jogo = addslashes($_POST['jogo']);
    //VERIFICA SE TODOS OS CAMPOS FORAM PREENCHIDOS
    if (!empty($titulo) && !empty($premio) && !empty($descricao) && !empty($jogo)) {

        $camp_service->cadastrarCampeonato($titulo, $premio, $descricao, $jogo);
        header("Location: ../view/listacampeonatos.php");
    }else{
        echo "PREENCHA TODOS OS DADOS";
    }
}
   
// ----------------------------------------------------------------------------------

// ------------------------- EDITAR VIDEOS -----------------------------------
if (isset($_POST['btn-editar'])) {// VERIFICA SE A PESSOA CLICKOU NO BOTÃO ADICIONAR AULA
    //RECEBE OS VALORES DOS FORMULÁRIOS E ADICIONA-OS EM VARIAVEIS
    $titulo = addslashes($_POST['titulo']); //A FUNÇÃO ADDSLASHES PROTEJE O CODIGO CONTRA CODIGOS MALICIOSOS
    $premio = addslashes($_POST['premio']);
    $descricao = addcslashes($_POST['descricao']);
    $jogo = addslashes($_POST['jogo']);
    $id_campeonato = addslashes($_POST['id_campeonato']);
    //VERIFICA SE TODOS OS CAMPOS FORAM PREENCHIDOS
    if (!empty($titulo) && !empty($premio) && !empty($descricao) && !empty($jogo)) {
        $res = $camp_service->buscarCampById($id_campeonato);
        if(!empty($res) && $res['id_campeonato'] != $id_campeonato){
            echo "ALTERAÇÃO DO CAMPEONATO INDISPONIVEL, CAMPEONATO JÁ CADASTRADO";
        }else{
            $camp_service->atualizarCampeonato($titulo, $premio, $descricao, $jogo, $id_campeonato);
            header("Location: ../view/listacampeonatos.php");
        }
        echo "PREENCHA TODOS OS DADOS";
    }
}   
// ----------------------------------------------------------------------------------

