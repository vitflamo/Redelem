<?php

include('classes/db.php');

//Monta
if (isset($_POST[registra])){

    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];

    if (!db::query('SELECT conta_apelido FROM conta WHERE conta_apelido=:apelido', array(':apelido'=>$apelido))){
        
        if(strlen($apelido) <= 32 ){

            if (preg_match('/[a-zA0Z0-9_]+/', $apelido)){ 

                if(strlen($senha) >= 4 && strlen($senha) <= 16){
                    db::query('INSERT INTO conta VALUES (null, :apelido, :senha, :email)', array(':apelido'=>$apelido , ':senha'=>password_hash($senha, PASSWORD_BCRYPT),':email'=>$email));
                    echo "<br>Cadastro realizado com Sucesso!<br>";
                    
                }else{
                    echo "<br>Senha fora do padrão<br>";
                }

            }else{
                echo "<br>Conta contém caracteres inválidos<br>";
            }
                  
        }else{
            echo "<br>Apelido muito longo<br>"; 
        }
        
    }else{
        echo "<br>Este Apelido já existe<br>";
    }
}

?>

<a href=index>Início</a><br>
<a href=entrar>Entrar</a>

<h1> Registre-se</h1>

<form action="registrar" method="post">
<input type="text" name="apelido" placeholder="Insira aqui seu apelido" required/><br><br>
<input type="password" name="senha" placeholder="Insira aqui sua senha" required /><br><br>
<input type="email" name="email" placeholder="Insira aqui seu e-mail" required /><br><br>

<input type="submit" name="registra" value="registrar">
</form>