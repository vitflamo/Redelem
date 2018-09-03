<?php

include('./classes/db.php');

function ContaLogada(){

    if (isset($_COOKIE['IDRS'])){

        if (db::query('SELECT conta_id FROM acesso WHERE acesso_chave=:chave', array(':chave'=>sha1($_COOKIE['IDRS'])))){
            return true;
        }else{
            return false;
        }

    }else{
        return false;
    }

}

if (ContaLogada()){
    echo "<br>Conta logada<br>";
}else{
    echo "<br>Você não está logado<br>";
}

?>

<a href=registrar>Cadastro</a><br>
<a href=entrar>Entrar</a>