<?php
/*function that connect*/
function authentification(){
    /*connect into the DB*/
    $host = 'localhost';
    $db   = 'galiixy';
    $user = 'galiixy';
    $pass = 'Jobslpxi';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    include ("./model/users.php");
    $login=$_POST['login'];
    $password=$_POST['password'];

    if($login == null and $password == null){
        require ("./views/home.php");
    }else{
        
        if(user_exists($login,$password)){
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
