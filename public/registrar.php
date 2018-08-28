<?php

include('classes/db.php');

//Monta
if (isset($_POST[registra])){
    $apelido = $_POST['apelido'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
}

db::query ('INSERT INTO contas 
VALUES (\'\', Conta_apelido, Conta_senha, Conta_email)',
array ('apelido' => $apelido , 
'senha' => $senha,
'email'=> $email ),
echo "Sucesso!";
);



?>


<h1> Registre-se</h1>

<form action="registrar.php" method="post">
<input type="text" name="apelido" placeholder="Insira aqui seu nome de usuario" required/>
<input type="password" name="senha" placeholder="Insira aqui sua senha" required />
<input type="email" name="email" placeholder="Insira aqui seu e-mail" required />

<input type="submit" name="registra" value="registrar">
</form>