<div class="escolha_jogos">
    <nav class="jogos">
        <li><a href="aulas.php?jogo_filtro=vlr"><img src="img/VLR_icon.png" alt="Valorant"/><span>VLR</span></a></li>
        <li><a href="aulas.php?jogo_filtro=lol"><img src="img/LOL_icon.png" alt="LeagueOfLegends"/><span>LOL</span></a></li>
        <li><a href="aulas.php?jogo_filtro=lor"><img src="img/LOR_icon.png" alt="LegendsOfRuneterra"/><span>LOR</span></a></li>
        <li> <a href="aulas.php?jogo_filtro=r6"><img src="img/R6_icon.png" alt="RainbowSix"/><span>RB6</span></a></li>
        <!-- Retirando o filtro, se necessário descomente a proxima linha -->
        <!--<li id="filter" onclick="document.getElementById('filtro').style.display='flex';document.getElementById('fechar').style.display='block';"><a><img src="img/filter.png" alt="filter"/></a></li>-->
    </nav>
</div>

<?php

    if (isset($_SESSION['adm'])) {
        if ($_SESSION['adm'] == true) {//VERIFICA SE A PESSOA É UM ADMINISTRADOR E SE ESTÁ LOGADA
            echo " <style type='text/css'>
                    .add_aula {
                        display:flex;
                    }
                    </style>";
        } else {
            echo " <style type='text/css'>
                    .add_aula {
                        display:none;
                    }
                    </style>";
        }
    } else {
        echo " <style type='text/css'>
                    .add_aula {
                        display:none;
                    }
                    </style>";
    }
    ?>

<div class="add_aula"><a><img src="img/adicionar.png" alt="add" id="add" onclick="document.getElementById('form-aulas').style.display='flex';document.getElementById('fechar2').style.display='block';"/></a><h4>Adicionar aula</h4></div>
