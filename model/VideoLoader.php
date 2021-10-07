<?php
class VideoLoader {
    
     private $pdo;
    
    //CONEXAO COM O BANCO DE DADOS
    public function __construct($dbname, $host, $user, $senha) {//CONSTRUTOR PARA O BANCO DE DADOS
        try{//TRY CATCH PARA TRATAMENTO DE ERROS
            $this -> pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);//CRIANDO O PDO DO BANCO
            
        } catch (PDOException $e) {//ERRO DO PDO
            echo "ERRO COM BANCO DE DADOS".$e->getMessage();
            exit();
            
        }catch(Exception $e){//ERRO COMUM SEM SER DO PDO
            echo "ERRO GENERICO".$e->getMessage();
            exit();
        } 
    }
    
    
    public function cadastrarVideos($titulo, $url, $jogo){
        $cmd = $this->pdo->prepare("SELECT id_video FROM Video_Aulas WHERE url = :u");//QUERY PARA PROCURAR A PESSOA PELO EMAIL
        $cmd->bindValue(":u", $url);//SUBSTITUI :u PELA URL PASSADA COMO PARAMETRO
        $cmd->execute();//EXECUTA A QUERY
        if($cmd->rowCount() > 0){//CONFERE SE O VIDEO JÁ FOI CADASTRADO ANTERIORMENTE
            return false;//VIDEOS JÁ CADASTRADO, NÃO CADASTRA NOVAMENTE
            
        }else{//VIDEO NÃO FOI ENCONTRADO NO BANCO
            $cmd = $this->pdo->prepare("INSERT INTO Video_Aulas(titulo, url, jogo) VALUES (:t, :u, :j)");//QUERY PARA O CADASTRO
            $cmd->bindValue(":t", $titulo);
            $cmd->bindValue(":u", $url);
            $cmd->bindValue(":j", $jogo);

            $cmd->execute();
            return true;//NOVO CADASTRO REALIZADO
        }
    }
    
    public function carregarVideos($jogo){
        //PARA CADA CASO OS VIDEOS EXIBIDOS NA TELA E SEUS RESPECTIVOS TITULOS SÃO MODIFICADOS    
        
       if (!empty($jogo)){
            $cmd = $this->pdo->prepare( "SELECT titulo, url FROM Video_Aulas WHERE jogo = :j;");//PEGA OS VIDEOS POR CATEGORIA
            $cmd->bindValue(":j", $jogo);
            $cmd->execute();
            
            if ($cmd->rowCount()>0) {//Enquanto tiverem linhas na tabela
                foreach($cmd as $res){
                    $titulo = $res['titulo'];
                    $url = $res['url'];
                    echo "<div class='video_aulas'>
                        <a><img href='../view/img/options.png'></a>
                        <iframe width='425' height='250' src='https://www.youtube.com/embed/$url' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                        <h5>$titulo</h5>
                    </div>";
                }
            }
            
        }else{
            $cmd = $this->pdo->prepare( "SELECT titulo, url FROM Video_Aulas;");//PEGA TODOS OS VIDEOS
            $cmd->execute();
            
            if ($cmd->rowCount()>0) {//Enquanto tiverem linhas na tabela
                foreach($cmd as $res){
                    $titulo = $res['titulo'];
                    $url = $res['url'];
                    echo "<div class='video_aulas'>
                        <a><img href='../view/img/options.png'></a>
                        <iframe width='425' height='250' src='https://www.youtube.com/embed/$url' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                        <h5>$titulo</h5>
                    </div>";
                }
            }
        }
    }

    public function getJogo() {
        return $this->jogo;
    }

    public function getConexao() {
        return $this->conexao;
    }

    public function setJogo($jogo): void {
        $this->jogo = $jogo;
    }

    public function setConexao($conexao): void {
        $this->conexao = $conexao;
    }



    
}
