<?php

include('./classes/db.php');
include('./classes/login.php');

if (!login::ContaLogada()){
    die("Você não entrou para poder sair");
}else{

}

if (isset($_POST['sim'])){

    if(isset($_POST['totalmente'])){

        db::query('DELETE FROM acesso WHERE conta_id=:conta',
        array(':conta'=>login::ContaLogada()));    
       
    }else{
        
        if(isset($_COOKIE['IDRS'])){
            db::query('DELETE FROM acesso WHERE acesso_chave=:chave',
            array(':chave'=>sha1($_COOKIE['IDRS'])));    
        }

        setcookie('IDRS', '1', time()-3600);
        setcookie('IDRS_TEMP', '1', time()-3600);
    }
}


?>

<a href=registrar>Cadastro</a><br>
<a href=entrar>Entrar</a><br>
<a href=index>Início</a><br>

<h1>Saindo da Redelem</h1>

Tem Certeza que deseja sair?
<form action="sair" method="post">
    <input type="checkbox" name="totalmente" value="totalmente">Todos os dispositivos?<br>
    <input type="submit" name="sim" value="Sim, desejo sair">
</form>