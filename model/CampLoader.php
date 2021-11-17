<?php
class CampLoader {
    
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

    public function buscarCampById($id_campeonato){// ADICIONADO EM 03/11
        $cmd = $this->pdo->prepare("SELECT * FROM campeonatos WHERE id_campeonato = :id");
        $cmd->bindValue(":id", $id_campeonato);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    
    public function cadastrarCampeonato($titulo, $premio,$descricao, $jogo){
               
            $cmd = $this->pdo->prepare("INSERT INTO campeonatos(titulo, premio, descricao, jogo) VALUES (:t, :u, :d, :j)");//QUERY PARA O CADASTRO
            $cmd->bindValue(":t", $titulo);
            $cmd->bindValue(":u", $premio);
            $cmd->bindValue(":d", $descricao);
            $cmd->bindValue(":j", $jogo);

            $cmd->execute();
            return true;//NOVO CADASTRO REALIZADO
        }
        
    public function atualizarCampeonatos($titulo, $premio, $descricao, $jogo, $id_campeonato){// ADICIONADO EM 03/11
        $cmd = $this->pdo->prepare("UPDATE campeonatos SET titulo = :t, premio = :u, descricao = :d, jogo = :j WHERE id_campeonato = :id");
        $cmd->bindValue(":t", $titulo);
        $cmd->bindValue(":u", $premio);
        $cmd->bindValue(":d", $descricao);
        $cmd->bindValue(":j", $jogo);
        $cmd->bindValue(":id", $id_campeonato);
        $cmd->execute();
    }
    
    public function excluirCampeonato($id_campeonato) {// ADICIONADO EM 03/11
        $cmd = $this->pdo->prepare("DELETE FROM campeonatos WHERE id_campeonato = :id");//QUERY DO MYSLQ PARA EXCLUSÃO DE INSERÇÕES
        $cmd->bindValue(":id",$id_campeonato);
        $cmd->execute();
    }

    public function carregarCampeonato($jogo,$reg_pag, $pg){
    //PARA CADA CASO OS VIDEOS EXIBIDOS NA TELA E SEUS RESPECTIVOS TITULOS SÃO MODIFICADOS 
    $inicio = ($pg - 1) * $reg_pag;
    
        if (!empty($jogo)){
            $cmd = $this->pdo->prepare( "SELECT id_campeonato, titulo, premio, descricao FROM campeonatos WHERE jogo = :j LIMIT $inicio,$reg_pag;");//PEGA OS VIDEOS POR CATEGORIA
            $cmd->bindValue(":j", $jogo);
            $cmd->execute();
            
            if ($cmd->rowCount()>0) {//Enquanto tiverem linhas na tabela
                foreach($cmd as $res){
                    $titulo = $res['titulo'];
                    $premio = $res['premio'];
                    $descricao = $res['descricao'];
                    $id_campeonato = $res['id_campeonato'];// --> 03/11
                    echo " <div class='card border-0.5'>
                            <img src='img/zed.png'/>
                             <div class='card-body'>
                              <h3 class='card-title'>$titulo</h3>
                               <p class='card-text'>$descricao</p>                 
                                <a href='campeonato.php' class='btn btn-bg'>Inscrever-se</a>";
            if (isset($_SESSION['adm']) && $_SESSION['adm'] == true){ //MOSTRA APENAS PARA ADMS  
                            echo "<sub id='alter_videos'>
                                    <a id='alter_aula' href='listacampeonatos.php?campeonato=$id_campeonato'/>Editar </a>
                                    |
                                    <a id='apagar' href='listacampeonatos.php?excluir=$id_campeonato'> Excluir</a>
                                  </sub>";
                        }                           
                            echo "</div></div>";               
                }
            }
            
            $total = $this->pdo->prepare( "SELECT * FROM campeonatos WHERE jogo = '$jogo';");
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
            $cmd = $this->pdo->prepare( "SELECT id_campeonato, titulo, premio, descricao FROM campeonatos LIMIT $inicio,$reg_pag;");//PEGA TODOS OS VIDEOS
            $cmd->execute();
                       
            if ($cmd->rowCount()>0) {//Enquanto tiverem linhas na tabela
                foreach($cmd as $res){
                    $titulo = $res['titulo'];
                    $premio = $res['premio'];
                    $descricao = $res['descricao'];
                    $id_campeonato = $res['id_campeonato'];
                    echo " <div class='card border-0.5'>
                            <img src='img/zed.png'/>
                             <div class='card-body'>
                              <h3 class='card-title'>$titulo</h3>
                               <p class='card-text'>$descricao</p>                 
                                <a href='campeonato.php' class='btn btn-bg'>Inscrever-se</a>";
            if (isset($_SESSION['adm']) && $_SESSION['adm'] == true){ //MOSTRA APENAS PARA ADMS  
                            echo "<sub id='alter_videos'>
                                    <a id='alter_aula' href='listacampeonatos.php?campeonato=$id_campeonato'/>Editar </a>
                                    |
                                    <a id='apagar' href='listacampeonatos.php?excluir=$id_campeonato'> Excluir</a>
                                  </sub>";
                        }                           
                            echo "</div></div>";
                }
            }
            
            $total = $this->pdo->prepare("SELECT * FROM campeonatos;");
            $total->execute();
            $tp = $total->rowCount()/$reg_pag;
            $tp = ceil($tp);
            
            echo "<div class='paginacao' style='pointer-events: none; opacity: 0.5;'>";
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