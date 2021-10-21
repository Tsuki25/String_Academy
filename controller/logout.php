<?php
    session_start();
    if($_SESSION['logado'] == true){
        session_unset();//limpa a sessão
        session_destroy();//destroi a sessão
        header('Location: ../view/aulas.php');//redireciona para a index
    }else{
        echo "Faça login primeiro, para deslogar.";
    }


