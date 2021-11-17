<link rel="stylesheet" href="css/estilos.css">

<?php
//START DE SESSÃO EM TODAS AS PAGINAS
session_start();
?>

<header>
    <a href="index.php" ><img src="img/icons/logo_string.png" alt="String Games"></a>
    <nav>
        <li>
            <div class="dropdown">
                <a class="menu-drop">CATEGORIAS</a>
                <div class="drop-conteudo">
                    <ul>
                        <li><a href="aulas.php" id="valorant">Aulas</a></li>
                        <li><a href="listacampeonatos.php">Campeonatos</a></li>
                    </ul>
                </div>
            </div>
        </li>
        <li><a href="contato.php">CONTATO</a></li> 
        <?php
            if (isset($_SESSION['logado'])) {//VERIFICA SE TENTOU LOGAR OU CRIAR CONTA
                if ($_SESSION['logado'] == true) {//VERIFICA SE ESTÁ LOGADO
                    echo "<li><a href='../view/user_template.php' class='fas fa-user-alt perfil'></a></li>"; 
                } else {//NÃO ESTÁ LOGADO(LOGOUT)
                    echo "<li><a onclick='document.getElementById('login-menu').style.display='flex';' class='fas fa-user-alt perfil' id='menuLg'></a></li>";
                }
            } else {//NÃO TENTOU CRIAR CONTA NEM LOGAR, NÃO ESTÁ LOGADO
                echo "<li><a onclick=document.getElementById('login-menu').style.display='flex'; class='fas fa-user-alt perfil' id='menuLg'></a></li>";
            }
        ?>
    </nav>
    
    <?php
    //MODIFICAR O ENCAMINHAMENTO DO ICONE DE PERFIL DO USUARIO
    if(isset($_SESSION['logado'])){//VERIFICA SE TENTOU LOGAR OU CRIAR CONTA
        if ($_SESSION['logado'] == true) {//VERIFICA SE ESTÁ LOGADO
            echo " <style type='text/css'>
            #menuLg {
                display: none;
            }
            #user-profile{
                display: contents;
            }
            </style>";
        } else {//NÃO ESTÁ LOGADO(LOGOUT)
            echo " <style type='text/css'>
            #menuLg {
                display: contents;
            }
            #user-profile{
                display: none;
            }
            </style>";
        }
    }else {//NÃO TENTOU CRIAR CONTA NEM LOGAR, NÃO ESTÁ LOGADO
            echo " <style type='text/css'>
            #menuLg {
                display: contents;
            }
            #user-profile{
                display: none;
            }
            </style>";
        }
        
    ?> 
</header>
<!--<a href="Jogos.php">JOGOS</a> -->