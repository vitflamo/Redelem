<?php

include('./classes/db.php');
include('./classes/login.php');

if (login::ContaLogada()){
    echo "<br>Conta logada<br>";
    echo login::ContaLogada();
}else{
    echo "<br>Você não está logado<br>";
}

?>

<a href=registrar>Cadastro</a><br>
<a href=entrar>Entrar</a><br>
<a href=sair>Sair</a>

