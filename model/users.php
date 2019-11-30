<?php
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

/*verify the login and password entered*/
function user_exists ($login,$password){
    if(login_exists($login)){
        $stmt = $pdo->query("select * from user where login='$login' and password = '$password'");
        if($stmt){
            return true;
        }
        return false;
    }
    return false;
}

/* verify if the login already exist in DB*/
function login_exists ($login){
    try{
        $stmt = $pdo->prepare('select Id_User from User where login=?');
        $stmt->execute([$login]);
    }catch(\PDOException $e){
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
        return false;
    }
    return true;
}


/* verify if the mail already exist in DB*/
function email_exists($email){
    $stmt = $pdo->query("select * from user where email='$email'");
    if ($stmt){
        return true;
    }
    else{
        return false;
    }
}

/* add user in the DB */
function create_user($login,$password,$last_name,$first_name,$email) {
    if(login_exists($login) or email_exist($email)){
        return false;
    }
    else{
        $sql = "INSERT INTO User (login,password,last_name,first_name,email) values (?,?,?,?,?)";
        $pdo->preapare($sql)->execute([$login,$password,$last_name,$first_name,$email]);
        return true;
    }
}

/*change login of a user*/
function change_login($login,$newlogin){
    if(!login_exists($newlogin)){
        return false;
    }else{
        $sql="UPDATE User set login=? where login=?";
        $pdo->preapare($sql)->execute([$newlogin,$login]);
        return true;
    }
}

/*change password of a user*/
function change_password($login,$password){
    $pdo->query("update Users set password='$password' where login='$login'");
}

/*delete a user from the DB*/
function delete_user($login){
    $pdo->query("delete form user where login='$$login'");
}