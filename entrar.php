<?php

include('classes/db.php');

if (isset($_POST[entra])){

    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];

    if (db::query('SELECT conta_apelido FROM conta WHERE conta_apelido=:apelido', array(':apelido'=>$apelido))){
       
        if(password_verify($senha, db::query('SELECT conta_senha FROM conta WHERE conta_apelido=:apelido',array(':apelido'=>$apelido))[0]['conta_senha'])){
            echo "<br>Entrando!<br>";

            $cstrong = true;
            $acesso = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
           
            $conta_id = db::query('SELECT conta_id FROM conta WHERE conta_apelido=:apelido', array(':apelido'=>$apelido))[0]['conta_id'];
            db::query('INSERT INTO acesso VALUES (null, :acesso, :conta_id)', array(':acesso'=>sha1($acesso), ':conta_id'=>$conta_id));
            
            setcookie("IDRS", $acesso, time() + 60 * 60 * 24 * 7, '/', null, null, true);

        }else{
            echo "<br>Senha Incorreta!<br>";
        }
      
    }else{
        echo "<br>Este apelido não foi registrado<br>";
    }
    
    

}

?>
<a href=registrar>Cadastro</a><br>
<a href=index>Início</a>

<h1>Entre</h1>

<form action="entrar" method="post">
<input type="text" name="apelido" placeholder="Insira aqui seu apelido" required/><br><br>
<input type="password" name="senha" placeholder="Insira aqui sua senha" required /><br><br>

<input type="submit" name="entra" value="entrar">
</form>