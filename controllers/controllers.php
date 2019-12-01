<?php
/*function that connect*/
function authentification(){
    include ("./model/users.php");
    $login=$_POST['login'];
    $password=$_POST['password'];

    if($login == null and $password == null){
        require ("./views/home.php");
    }else{
        
        if(user_exists_db($login,$password)){
            $_SESSION['login']=$login;
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

        if(login_exists_db($login)){
            $_SESSION['error_login']='login already use';
        }
        elseif(email_exists_db($email)){
            $_SESSION['error_email']='email already use';
        }
        elseif($password !== $password_confirm){
            $_SESSION['error_password']='not the same password';
        }else{
            create_user_db($login,$password,$last_name,$first_name,$email);
        }
    }

}

/*sign Out*/
function signOut(){
    include ("./model/users.php");
    session_start();
    session_destroy();
    require ("./views/home.php");
}

/*open the fridge page*/
function fridge(){
     include ("./model/fridge.php");

     require ("./views/fridge.php");
}

function food_user(){
    include ("./model/fridge.php");
    $login = $_SESSION['login'];
    $foods = 'you have no food';

    try{
        $foods=get_user_db($login);
        return $foods;
    }catch (\PDOException $e){
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
        return $foods;
    }
    return $foods;
}

/*open the profile page*/
function profile(){
    include ("./model/users.php");
    require ("./views/profile.php");
}

/*add header on top of every page*/
function head(){
    include ("./model/users.php");
    require ("./views/header.php");
}

/*add footer on the bottom of every page*/
function foot(){
    include ("./model/users.php");
    require ("./views/footer.php");
}

/*change login */
function change_login(){
    include ("./model/users.php");
    $login=$_POST['login'];
    $new_login=$_POST['new_login'];
    if (count($_POST)==0){
        require ("./views/change_login.php");
    }else{
        if(!change_login_db($login)){
            $_SESSION['error_login']='login already used';
        }
        else{
            require ("./views/profile.php");
        }
    }      
}