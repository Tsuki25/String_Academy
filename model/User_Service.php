<?php

class User_Service{
    
    private $pdo;
    
    public function __construct($dbname, $host, $user, $senha) {//CONSTRUTOR PARA O BANCO DE DADOS
        try {//TRY CATCH PARA TRATAMENTO DE ERROS
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha); //CRIANDO O PDO DO BANCO
        } catch (PDOException $e) {//ERRO DO PDO
            echo "ERRO COM BANCO DE DADOS" . $e->getMessage();
            exit();
        } catch (Exception $e) {//ERRO COMUM SEM SER DO PDO
            echo "ERRO GENERICO" . $e->getMessage();
            exit();
        }
    }
    
    public function buscarDados(){//FUNCAO PARA BUSCAR OS DADOS E COLOCAR NA TABELA DA DIREITA
        $res = array();// CRIADO COMO ARRAY PARA EVITAR ERROS COM BANCO DE DADOS VAZIO
        
        $cmd = $this->pdo->query("SELECT * FROM users");//PEGA OS VALORES DO BANCO
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);//USADO PARA RECEBER OS VALORES DO BANCO COMO ARRAY
        
        return $res;//RETORNA O CADASTROS PARA QUEM CHAMAR O METODO
    }
    
    public function buscarUser($email){
        $cmd = $this->pdo->prepare("SELECT * FROM users WHERE email = :e");
        $cmd->bindValue(":e", $email);
        return $cmd->execute();
    }
    
    public function login($email, $senha){//EU ACHO QUE AQUI É ONDE MORA O PROBLEMA, MAS JÁ TESTEI TODAS AS MINHAS IDEIAS E NADA FUNCIONA
        $cmd = $this->pdo->prepare("SELECT * FROM users WHERE email = :e AND senha = :s");
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":s", $senha);
        $cmd->execute();
        $aux = array();
        $aux = $cmd->fetch(PDO::FETCH_ASSOC);//TRANSFORMA O BANCO EM UM ARRAY
        if($cmd->rowCount() == 1){// VERIFICA SE NO BANCO EXISTE UM LOGIN E SENHA ATRELADOS IGUAIS AO PASSADO PELO USUARIO
            session_unset();
            $_SESSION ['logado'] = true; 
            $_SESSION['user'] = $aux['id_jogador'];// SETA A SESSÃO
            $_SESSION['adm'] = $aux['adm'];//SETA A SESSÃO, MAS SEMPRE FICA VAZIO(eu acho)
            header("Location: ../view/aulas.php"); 
        }else{
            echo "Login/Senha incorreto";
            return false;
        }
            
    }
    
    public function cadastroUsuario($nome, $senha, $nick, $anoNasc,$email, $genero, $adm){
        $idade = date(Y) - $anoNasc;
        
        $cmd = $this->pdo->prepare("SELECT * FROM users WHERE email = $email");//QUERY PARA PROCURAR A PESSOA PELO EMAIL
        $cmd->execute();//EXECUTA A QUERY
        if($cmd->rowCount() > 0){//CONFERE SE O EMAIL JÁ FOI CADASTRADO 
            return false;
            
        }else{      
            $cmd = $this->pdo->prepare("INSERT INTO users VALUES (default, :n, :i, MD5(:s), :e, :ni, :g, :ad)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":i", $idade);
            $cmd->bindValue(":s", $senha);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":ni", $nick);
            $cmd->bindValue(":g", $genero);
            $cmd->bindValue(":ad", $adm);
            $cmd->execute();
            return true;
        }
    }
    
}




