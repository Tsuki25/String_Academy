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
        $resp = $user_service->buscarUser($email);
        if(!empty($resp)){
            echo " EMAIL JÁ CADASTRADO ";
        }else{
            $user_service->cadastroUsuario($nome, $senha, $nick, $anoNasc, $email, $genero, $adm);
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
            header('Location: ../view/user_template.php ');
        }else{//SE NÃO EXISTIR, ADICIONE UM ERRO A VARIAVEL
            echo "USUÁRIO NÃO ENCONTRADO";
        }
    }else{
        echo "PREENCHA TODOS OS CAMPOS";
    }
}

if(isset($_POST['btn-atualizar'])){//VERIFICA SE CLICOU NO BOTÃO DE ATUALIZAÇÃO
    $nome = addslashes($_POST['nome']);
    $nick = addslashes($_POST['nick']);
    $anoNasc = addslashes($_POST['anoNasc']);
    $email = addslashes($_POST['email']);
    $genero = addslashes($_POST['genero']);
    $descricao = addslashes($_POST['descricao']);
    $imagem = $_FILES['imagem'];
    $id = $_SESSION['user'];
    
    if(!empty($nome) && !empty($nick) && !empty($anoNasc) && !empty($email) && !empty($genero)){
        $resp = $user_service->buscarUser($email);
        if(!empty($resp) && $resp['id_jogador'] != $_SESSION['user']){
            echo "ALTERAÇÃO NO EMAIL INDISPONIVEL, JÁ CADASTRADO";
        }else{
            if(empty($imagem["tmp_name"])){
                $nome_img = $resp['img_user'];
                $user_service->atualizacaoDados($nome,$nick,$anoNasc,$email,$genero,$descricao, $id, $nome_img);
                header('Location: ../view/user_template.php');
            }else{
                $largura = 1000;
                $altura = 1000;
                $dimensoes = getimagesize($imagem["tmp_name"]);
                
                if(!preg_match("/^image\/(jpeg|png)$/", $imagem["type"])){//VERIFICA SE O ARQUIVO É UMA IMAGEM
                   echo "Isso não é uma imagem.";
                }else{
                    // VERIFICA SE AS DIMENSÕES SÃO ACEITAS
                    if($dimensoes[0] > $largura || $dimensoes[1] > $altura) {
                        echo "A imagem deve possuir largura máxima de ".$largura.", altura máxima de ". $altura;
                    }else{
                        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);//PEGA A EXTENSÃO DA IMAGEM
                        $nome_imagem = md5($nick.$id.time()) . "." . $ext[1];//GERA O NOME DA IMAGEM
                        $caminho_imagem = "../view/img/profile_user/" . $nome_imagem;
                        move_uploaded_file($imagem["tmp_name"], $caminho_imagem);//ENVIA A IMAGEM PARA O SEU LOCAL DE ARMAZENAMENTO

                        $user_service->atualizacaoDados($nome,$nick,$anoNasc,$email,$genero,$descricao, $id, $nome_imagem);
                        header('Location: ../view/user_template.php');
                    }
                } 
            }
            
        }
    }    
}

