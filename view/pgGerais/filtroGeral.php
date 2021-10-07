<article class="filtro" id="filtro">
    <form method="get" action="">
        <a><img src="img/fechar.png" alt="fechar" id="fechar" onclick="document.getElementById('filtro').style.display='none';document.getElementById('fechar').style.display='none';"/></a>
        <h3 class>Filtar:</h3> 
        <hr>
        <input type="checkbox" id="todos" name="todos" value="Todos" checked>
        <label for="todos"> Todos</label><br>
        <input type="checkbox" id="conceitos_bas" name="conceitos_bas" value="Conceitos_basicos">
        <label for="conceitos_bas"> Conceitos Básicos</label><br>
        <input type="checkbox" id="mira" name="mira" value="Mira">
        <label for="mira"> Mira</label><br>
        <input type="checkbox" id="movimentacao" name="movimentacao" value="Movimentacao">
        <label for="movimentacao"> Movimentação</label><br>
        <input type="checkbox" id="comunicacao" name="comunicacao" value="Comunicacao">
        <label for="comunicacao"> Comunicação</label><br>
        <input type="checkbox" id="spots" name="spots" value="spots">
        <label for="spots"> Spots</label><br>
        <br>
        <input type="text" name="busca" placeholder="Search" id="caixa_busca"/>
        <label for="busca"><i class='fas fa-search' style='font-size:20px'></i></label>
        <br>
        <input type="submit" value="Filtrar" id="filtrar" class="btn-busca"/>
    </form>
</article>


