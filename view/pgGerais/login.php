<div class="login-menu fechar" id="login-menu">
    <p class="titulo">Entrar</p><br/>
    <form method="POST" action="../controller/user_controller.php">
        <label for="login">Login: </label><br/>
        <input type="text" name="email" placeholder="Email"/><br/>
        <br/>
        <label for="senha">Senha: </label><br/>
        <input type="password" name="senha" placeholder="Senha"/>
        <br/>
        <input type="submit" value="Entrar" id="Entrar" name="btn-login" class="btn-form"/>
        <input type="button" value="Fechar" id="Fechar" class="btn-form sair" onclick="document.getElementById('login-menu').style.display='none';"/>
    </form>
    <p id="cadastre-se">Não possui conta?<a href="cadastro.php">(Cadastrar-se)</a></p>
</div> 

