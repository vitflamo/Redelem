<?php

include('./classes/db.php');

if (isset($_POST['recuperasenha'])){

    $cstrong = true;
    $cript = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
    $email = $_POST['email'];

    $conta_id = db::query('SELECT conta_id FROM conta WHERE conta_email=:email',
    array(':email'=>$email))[0]['conta_id'];
    
    db::query('INSERT INTO senha VALUES (null, :cript, :conta_id)', 
    array(':acesso'=>sha1($cript), ':conta_id'=>$conta_id));

    echo 'Email Enviado';
}

?>

<br><br>
<a href=registrar>Cadastro</a><br>
<a href=entrar>Entrar</a><br>
<a href=sair>Sair</a><br>

<h1> Recuperação de Senha </h1>
<form action="recuperasenha" method="post">
    <input type="text" name="email" value=""" placeholder="Email"><br>
    <input type="submit" name="recuperar" value="Enviar nova senha">
</form>