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
    
    public function buscarVideo($url){// ADICIONADO EM 03/11
        $cmd = $this->pdo->prepare("SELECT * FROM video_aulas WHERE url = :u");
        $cmd->bindValue(":u", $url);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    
    public function buscarVideoById($id){// ADICIONADO EM 03/11
        $cmd = $this->pdo->prepare("SELECT * FROM video_aulas WHERE id_video = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
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
    
    public function atualizarVideos($titulo, $url, $jogo, $id_video){// ADICIONADO EM 03/11
        $cmd = $this->pdo->prepare("UPDATE video_aulas SET titulo = :t, url = :u, jogo = :j WHERE id_video = :id");
        $cmd->bindValue(":t", $titulo);
        $cmd->bindValue(":u", $url);
        $cmd->bindValue(":j", $jogo);
        $cmd->bindValue(":id", $id_video);
        $cmd->execute();
    }
    
    public function excluirVideo($id) {// ADICIONADO EM 03/11
        $cmd = $this->pdo->prepare("DELETE FROM video_aulas WHERE id_video = :id");//QUERY DO MYSLQ PARA EXCLUSÃO DE INSERÇÕES
        $cmd->bindValue(":id",$id);
        $cmd->execute();
    }
    
    public function carregarVideos($jogo,$reg_pag, $pg){
    //PARA CADA CASO OS VIDEOS EXIBIDOS NA TELA E SEUS RESPECTIVOS TITULOS SÃO MODIFICADOS 
    $inicio = ($pg - 1) * $reg_pag;
    
        if (!empty($jogo)){
            $cmd = $this->pdo->prepare( "SELECT id_video, titulo, url FROM Video_Aulas WHERE jogo = :j LIMIT $inicio,$reg_pag;");//PEGA OS VIDEOS POR CATEGORIA
            $cmd->bindValue(":j", $jogo);
            $cmd->execute();
            
            if ($cmd->rowCount()>0) {//Enquanto tiverem linhas na tabela
                foreach($cmd as $res){
                    $titulo = $res['titulo'];
                    $url = $res['url'];
                    $id_video = $res['id_video'];// --> 03/11
                    echo "<div class='video_aulas'>
                        <a><img href='../view/img/options.png'></a>
                        <iframe width='425' height='250' src='https://www.youtube.com/embed/$url' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                        <h5>$titulo</h5>";
                        if (isset($_SESSION['adm']) && $_SESSION['adm'] == true){ //MOSTRA APENAS PARA ADMS  
                            echo "<sub id='alter_videos'>
                                    <a id='alter_aula' href='aulas.php?video=$id_video'/>Editar </a>
                                    |
                                    <a id='apagar' href='aulas.php?excluir=$id_video'> Excluir</a>
                                </sub>";
                        } 
                    echo "</div>";
                }
            }
            
            $total = $this->pdo->prepare( "SELECT * FROM Video_Aulas WHERE jogo = '$jogo';");
            $total->execute();
            $tp = $total->rowCount()/$reg_pag;
            $tp = ceil($tp);

            
            echo "<div class='paginacao'>";
            $anterior = $pg - 1;
            $proximo = $pg + 1;
            if($pg == $tp && $anterior == 0){
                echo "<a href='?jogo_filtro=$jogo&pagina=$anterior' style='pointer-events: none; opacity: 0.5;'><img src='../view/img/back.png' style='widht:50px; height:50px;'></a>"
                    . " | " .
                    "<a href='?jogo_filtro=$jogo&pagina=$proximo' style='pointer-events: none; opacity: 0.5;'><img src='../view/img/next.png' style='widht:50px; height:50px;'></a>".
                    "</div>";
                
            }else if($pg == $tp){
                echo "<a href='?jogo_filtro=$jogo&pagina=$anterior'><img src='../view/img/back.png' style='widht:50px; height:50px;'></a>"
                    . " | " .
                    "<a href='?jogo_filtro=$jogo&pagina=$proximo' style='pointer-events: none; opacity: 0.5;'><img src='../view/img/next.png' style='widht:50px; height:50px;'></a>".
                    "</div>";
                
            }else if( $anterior == 0){
                echo "<a href='?jogo_filtro=$jogo&pagina=$anterior' style='pointer-events: none; opacity: 0.5;'><img src='../view/img/back.png' style='widht:50px; height:50px;'></a>"
                    . " | " .
                    "<a href='?jogo_filtro=$jogo&pagina=$proximo' ><img src='../view/img/next.png' style='widht:50px; height:50px;'></a>".
                    "</div>";
                
            }else{
                echo "<a href='?jogo_filtro=$jogo&pagina=$anterior'><img src='../view/img/back.png' style='widht:50px; height:50px;'></a>"
                    . " | " .
                    "<a href='?jogo_filtro=$jogo&pagina=$proximo'><img src='../view/img/next.png' style='widht:50px; height:50px;'></a>".
                    "</div>";
            }
            
        }else{
            $cmd = $this->pdo->prepare( "SELECT id_video, titulo, url FROM Video_Aulas LIMIT $inicio,$reg_pag;");//PEGA TODOS OS VIDEOS
            $cmd->execute();
                       
            if ($cmd->rowCount()>0) {//Enquanto tiverem linhas na tabela
                foreach($cmd as $res){
                    $titulo = $res['titulo'];
                    $url = $res['url'];
                    $id_video = $res['id_video'];
                    echo "<div class='video_aulas'>
                        <iframe width='425' height='250' src='https://www.youtube.com/embed/$url' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                        <h5>$titulo</h5>";
                        if (isset($_SESSION['adm']) && $_SESSION['adm'] == true){    
                            echo "<sub id='alter_videos'>
                                    <a id='alter_aula' href='aulas.php?video=$id_video'>Editar </a>
                                    |
                                    <a id='apagar' href='aulas.php?excluir=$id_video'> Excluir</a>
                                </sub>";
                        }  
                    echo "</div>";
                }
            }
            
            $total = $this->pdo->prepare("SELECT * FROM Video_Aulas;");
            $total->execute();
            $tp = $total->rowCount()/$reg_pag;
            $tp = ceil($tp);
            
            echo "<div class='paginacao'>";
            $anterior = $pg - 1;
            $proximo = $pg + 1;
            if($pg == $tp && $anterior == 0){
                echo "<a href='?pagina=$anterior' style='pointer-events: none; opacity: 0.5;'><img src='../view/img/back.png' style='widht:50px; height:50px;'></a>"
                    . " | " .
                    "<a href='?pagina=$proximo' style='pointer-events: none; opacity: 0.5;'><img src='../view/img/next.png' style='widht:50px; height:50px;'></a>".
                    "</div>";
                
            }else if($pg == $tp){
                echo "<a href='?pagina=$anterior'><img src='../view/img/back.png' style='widht:50px; height:50px;'></a>"
                    . " | " .
                    "<a href='?pagina=$proximo' style='pointer-events: none; opacity: 0.5;'><img src='../view/img/next.png' style='widht:50px; height:50px;'></a>".
                    "</div>";
                
            }else if($anterior == 0){
                echo "<a href='?jogo_filtro=$jogo&pagina=$anterior' style='pointer-events: none; opacity: 0.5;'><img src='../view/img/back.png' style='widht:50px; height:50px;'></a>"
                    . " | " .
                    "<a href='?jogo_filtro=$jogo&pagina=$proximo' ><img src='../view/img/next.png' style='widht:50px; height:50px;'></a>".
                    "</div>";
                    
            }else{
                echo "<a href='?pagina=$anterior'><img src='../view/img/back.png' style='widht:50px; height:50px;'></a>"
                    . " | " .
                    "<a href='?pagina=$proximo'><img src='../view/img/next.png' style='widht:50px; height:50px;'></a>".
                    "</div>";
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
