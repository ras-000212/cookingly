<?php

/*function that connect*/
function authentification(){
    $login=$_POST['login'];
    $password=$_POST['password'];

    if($login == null and $ $password == null){
        require("../views/home.php");
    }else{
        
        if(sign_in($login,$password)){
            $_SESSION['pseudo']=$pseudo;
            $url ="index.php?controle=controllers&action=fridge";
            header("Location:" .$url);
        }else{
            $_SESSION['error']='invalid login or password';
            require("../views/home.php");
        }
    }
}