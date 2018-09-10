<?php

Class login{

    public static function ContaLogada(){

        if (isset($_COOKIE['IDRS'])){
    
            if (db::query('SELECT conta_id FROM acesso WHERE acesso_chave=:chave', 
            array(':chave'=>sha1($_COOKIE['IDRS'])))){
                
                $conta_id = db::query('SELECT conta_id FROM acesso WHERE acesso_chave=:chave',
                array(':chave'=>sha1($_COOKIE['IDRS'])))[0]['conta_id'];
    
                if(isset($_COOKIE["IDRS_TEMP"])){
                    
                    echo "<br> ID da Conta: ";
                    return $conta_id;
                
                }else{
    
                    $cstrong = true;
                    $acesso = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));    
                    
                    db::query('INSERT INTO acesso VALUES (null, :acesso, :conta_id)', 
                    array(':acesso'=>sha1($acesso), ':conta_id'=>$conta_id));
                    
                    db::query('DELETE FROM acesso VALUES (null, :acesso, :conta_id) WHERE acesso=:acesso', 
                    array(':acesso'=>sha1($_COOKIE['acesso'])));
                
                    return $conta_id;
                }
                
            }else{         
                return false;
            }
    
        }else{
            return false;
        }
    
    }
}

?>