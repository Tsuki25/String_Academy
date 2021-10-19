<?php

require_once '../model/User_Service.php';
$user_service = new User_Service("bd_vector_academy", "localhost", "root", "");
session_start();

// CLICOU NO BOTÃO CADASTRAR
if(isset($_POST['btn-cadastro'])){
    $nome = addslashes($_POST['nome']);
    $senha = addslashes($_POST['senha']);
    $nick = addslashes($_POST['nick']);
    $anoNasc = addslashes($_POST['anoNasc']);
    $email = addslashes($_POST['email']);
    $genero = addslashes($_POST['genero']);
    $adm = false;
    
    if(!empty($nome) && !empty($senha) && !empty($nick) && !empty($anoNasc) && !empty($email) && !empty($genero)){
        if($user_service->cadastroUsuario($nome, $senha, $nick, $anoNasc, $email, $genero, $adm) == false){
            echo " EMAIL JÁ CADASTRADO ";
        }else{
            session_unset();
            $_SESSION ['logado'] = true;
            $res = $user_service->buscarUser($email);
            $_SESSION['user'] = $res['id_jogador'];
            $_SESSION['adm'] = false;
            header("Location: ../view/aulas.php");
        }   
    }else{
        echo "PREENCHA TODOS OS DADOS";
    }
}

//CLICOU NO BOTÃO DE LOGIN DO MENU
if(isset($_POST['btn-login'])){
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    
    if(!empty($email) && !empty($senha)){//VERIFICA SE OS CAMPOS ESTÃO VAZIOS
    $res = $user_service->buscarUser($email);//BUSCA UM USUARIO COM ESSAS CREDENCIAIS
        if(!empty($res)){//VERIFICA SE EXISTIR ALGUM REGISTRO COM ESSE LOGIN
            $senha = MD5($senha);//CRIPTOGRAFA A SENHA
            $user_service->login($email, $senha);
        }else{//SE NÃO EXISTIR, ADICIONE UM ERRO A VARIAVEL
            echo "USUÁRIO NÃO ENCONTRADO";
        }
    }else{
        echo "PREENCHA TODOS OS CAMPOS";
    }
}

