<?php

include('./classes/db.php');
include('./classes/login.php');
$chavevalida = false;

if (login::ContaLogada()){
    
    if (isset($_POST['mudasenha'])){
        
        $conta_id = login::ContaLogada();
        
        $senhavelha = $_POST['senhavelha'];
        $senhanova = $_POST['senhanova'];
        $senhanovaok = $_POST['senhanovaok'];
        
        if(password_verify($senhavelha, db::query('SELECT conta_senha FROM conta WHERE conta_id=:conta_id', 
        array(':conta_id'=>$conta_id))[0]['conta_senha'])){

            if($senhanova == $senhanovaok){

                if(strlen($senhanova) >= 4 && strlen($senhanova) <= 16){

                    db::query('UPDATE conta SET conta_senha=:senhanova WHERE conta_id',
                    array(':senhanova'=>password_hash($senhanova, PASSWORD_BCRYPT),':conta_id'=>$conta_id));
                    
                    echo '<br>Senhas atualizada com sucesso<br>';
                }else{
                    echo '<br>Senha nova está fora dos padrões<br>';
                }

            }else{
                echo '<br>Senhas novas não são iguais<br>';
        
            }

        }else{
            echo '<br>Senha Atual Incorreta<br>';
        }
        
    }

}else{
    
    
    if (isset($_GET['senha'])){

        $senha = $_GET['senha'];

        if (db::query('SELECT conta_id FROM senha WHERE cript=:cript',
        array(':cript'=>sha1($cript)))[0]['conta_id']){
    
            $conta_id = db::query('SELECT conta_id FROM senha WHERE cript=:cript',
            array(':cript'=>sha1($cript)))[0]['conta_id'];
    
            $chavevalida = true;

            if (isset($_POST['mudasenha'])){
            
                $senhanova = $_POST['senhanova'];
                $senhanovaok = $_POST['senhanovaok'];
        
                if($senhanova == $senhanovaok){
    
                    if(strlen($senhanova) >= 4 && strlen($senhanova) <= 16){
    
                        db::query('UPDATE conta SET conta_senha=:senhanova WHERE conta_id',
                        array(':senhanova'=>password_hash($senhanova, PASSWORD_BCRYPT),':conta_id'=>$conta_id));
                        
                        db::query('DELETE FROM senha WHERE conta_id=:conta_id',
                        array(':conta_id'=>$conta_id));

                        echo '<br>Senhas atualizada com sucesso<br>';
                    }else{
                        echo '<br>Senha nova está fora dos padrões<br>';
                    }
    
                }else{
                    echo '<br>Senhas novas não são iguais<br>';
                }
    
            }else{
                echo '<br>Senha não pode ser atualizada<br>';
            }
        
    
        }else{
            die("Token de senha invalido");
        }

    }else{
        die("Não está Logado");
    }
   
}

?>
<br><br>
<a href=registrar>Cadastro</a><br>
<a href=entrar>Entrar</a><br>
<a href=sair>Sair</a>

<h1>Nova Senha</h1>


<form action="
    <?php 
        if(!$chavevalida){
            echo 'novasenha';
        }else{
            echo 'novasenha?senha='.$senha.'';
        }
    ?> 
method="post">
    <?php 
        if (!$chavevalida){
             echo '<input type="password" name="senhavelha" value=""" placeholder="Senha Atual"><br>';  
        }
    ?>
    <input type="password" name="senhanova" value=""" placeholder="Senha Nova"><br>
    <input type="password" name="senhanovaok" value=""" placeholder="Repita a Senha Nova"><br>
    <input type="submit" name="mudasenha" value="Mudar Senha">
</form>