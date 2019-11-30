<?php

/*function that connect*/
function authentification(){
    include ("./model/users.php");
    $login=$_POST['login'];
    $password=$_POST['password'];

    if($login == null and $password == null){
        require ("./views/home.php");
    }else{
        
        if(user_exists($login,$password)){
            $_SESSION['pseudo']=$pseudo;
            $url ="index.php?controle=controllers&action=fridge";
            header("Location:" .$url);
        }else{
            $_SESSION['error']='invalid login or password';
            require ("./views/home.php");
        }
    }
}


function sign_up(){
    include ("./model/users.php");
    if (count($_POST)==0){
        require ("./views/signUp.php");
    }else{


        $login = $_POST['login'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email=$_POST['email'];

        if(login_exists($login)){
            $_SESSION['error_login']='login already use';
        }
        elseif(email_exists($email)){
            $_SESSION['error_email']='email already use';
        }
        elseif($password !== $password_confirm){
            $_SESSION['error_password']='not the same password';
        }else{
            create_user($login,$password,$last_name,$first_name,$email);
        }
    }


}
