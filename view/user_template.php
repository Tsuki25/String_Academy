<?php
    require_once '../model/User_Service.php';
    $user_service = new User_Service("bd_vector_academy", "localhost", "root", "");
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
                        
        <link href="css/formLogin.css" rel="stylesheet" type="text/css"/>
        <link href="css/pg_user.css" rel="stylesheet" type="text/css"/>
        
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="icon" href="img/icons/Site_Icone.png"> 
        
        <title>String Games</title>
    </head>
    <body>
        <?php
            include_once ("pgGerais/cabecalho.php");//cabeçalho
            include_once ("pgGerais/login.php");//login
        ?>
        
        <?php
            if(isset($_SESSION['logado'])){
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                    $id = $_SESSION['user'];
                    $res = $user_service->buscarUserById($id);
                    $nick = $res['nick'];
                    $nome = $res['nome'];
                    $email = $res['email'];
                    $idade = $res['idade'];
                    $genero = $res['genero'];
                    $descricao = $res['descricao'];
                    $imagem = $res['img_user'];
                    
                    $anoNasc = date('Y') - $idade;
                }else{
                    header('Location: ../view/aulas.php');
                }
            }else{
                header('Location: ../view/aulas.php');
            }
            
            if(isset($_GET['usuario'])&& !empty($_GET['usuario'])){//VERIFICA SE CLICOU NO EDITAR
                echo "<style>
                        .content{display: none;}
                        
                        .atualizar-cadastro{display: flex;}
                    </style>";
            }else{
                echo "<style>
                        .content{display: flex;}
                        
                        .atualizar-cadastro{display: none;}
                    </style>";
            }
            
            if(isset($_GET['encerrar'])&& !empty($_GET['encerrar'])){//VERIFICA SE CLICOU NO EDITAR
                $id_end = addslashes($_GET['encerrar']);
                $user_service->apagarConta($id_end);
                session_unset();//limpa a sessão
                session_destroy();//destroi a sessão
                header('Location: index.php');//redireciona para a index
            }
        ?>
        
        <section class="content" id="profile">
            <article class="user">
                <div class="img_profile">
                    <?php
                        if(empty($imagem)){
                            echo "<img src='../view/img/profile_user/tsuki.jpg' style='object-fit: cover;'/>";
                        }else{
                            echo "<img src='../view/img/profile_user/".$imagem."' style='object-fit: cover;'/>";
                        }
                    ?>
                    
                </div>
                <h3> <?php echo "$nick" ?> </h3>
                <sub>
                    <a id="alter_user" href="user_template.php?usuario=<?php echo "$id"; ?>">Editar </a>
                    |
                    <a id="Logout" href="../controller/logout.php"> Logout</a>
                    |
                    <a id="encerrar" href="user_template.php?encerrar=<?php echo "$id"; ?>">Encerrar Conta</a>
                </sub>
            </article>
            
            <article class="informacoes" id="informacoes">
                <p><span>Nome: </span> <?php echo "$nome"; ?></p>
                <p><span>E-mail: </span> <?php echo "$email";?></p>
                <p><span>Idade: </span> <?php echo "$idade"; ?></p>
                <p><span>Genêro: </span> <?php echo "$genero"; ?></p>
                <p><span>Descrição: </span> <?php echo "$descricao"; ?> </p>
            </article>
        </section>
        
        <section class="atualizar-cadastro" id="att-cadastro">
            <article class="editar">
                <p class="titulo">Editar</p><br/>
                <form method="POST" action="../controller/user_controller.php" enctype="multipart/form-data">
                    <label for="nome">Nome: </label><br/>
                    <input type="text" name="nome" value="<?php echo "$nome" ?>"/><br/>
                    <br/>
                    <label for="nick">Nick: </label><br/>
                    <input type="text" name="nick" value="<?php echo "$nick" ?>"/><br/>
                    <br/>
                    <label for="anoNasc">Ano de nascimento: </label><br/>
                    <input type="number" name="anoNasc" value="<?php echo "$anoNasc" ?>" size="4" max="2008" min="1940"/><br/>
                    <br/>
                    <label for="email">Email: </label><br/>
                    <input type="email" name="email" value="<?php echo "$email" ?>"/><br/>
                    <br/>
                    <label for="descricao">Descrição: </label><br/>
                    <input type="text" name="descricao" value="<?php echo "$descricao" ?>" height="100"/><br/>
                    <br/>
                    <label for="genero">Genêro: </label><br/>
                    <fieldset>
                        <input type="radio" name="genero" id="masc" value="masculino" <?php if($genero == "masculino"){echo "CHECKED";} ?>/>
                        <label for="masc" class="opcoesGenero">Masculino</label><br/>
                        <input type="radio" name="genero" id="fem" value="feminino" <?php if($genero == "feminino"){echo "CHECKED";} ?>/>
                        <label for="fem" class="opcoesGenero">Feminino</label><br/>
                        <input type="radio" name="genero" id="outro" value="outro" <?php if($genero == "outro"){echo "CHECKED";} ?>/>
                        <label for="outro" class="opcoesGenero">Outro</label><br/>
                    </fieldset><br/>
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem" />
                    <br/>
                    <input type="submit" value="Atualizar" id="atualizar" name="btn-atualizar" class="btn-form" />
                </form>
            </article>
        </section>
        
        <?php
            include_once("pgGerais/newsletter.php");//rodape
        ?>
    </body>
</html>