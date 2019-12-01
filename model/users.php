<?php
/*verify the login and password entered*/
function user_exists_db ($login,$password){
    include ('./model/connectDB.php');
    if(login_exists_db($login)){
        $stmt = $pdo->query("select * from User where login='$login' and password = '$password'");
        if($row = $stmt->fetch()){
            return true;
        }
        return false;
    }
    return false;
}

/* verify if the login already exists in DB*/
function login_exists_db ($login){
    include ('./model/connectDB.php');
    try{
        $stmt = $pdo->prepare('select Id_User from User where login=?');
        $stmt->execute([$login]);
        //true if the login exists
        if ($res = $stmt->fetch()){
            return true;
        }
        return false;
    }catch(\PDOException $e){
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
        //false if the login doesn't exist
        return false;
    }
}


/* verify if the mail already exists in DB*/
function email_exists_db($email){
    include ('./model/connectDB.php');
    $stmt = $pdo->query("select * from User where email='$email'");
    if ($stmt){
        //true if the email exists
        return true;
    }
    else{
        //false if the email doesn't exist
        return false;
    }
}

/* add user in the DB */
function create_user_db($login,$password,$last_name,$first_name,$email) {
    include ('./model/connectDB.php');
    if(login_exists_db($login) or email_exist($email)){
        return false;
    }
    else{
        $sql = "INSERT INTO User (login,password,last_name,first_name,email) values (?,?,?,?,?)";
        $pdo->prepare($sql)->execute([$login,$password,$last_name,$first_name,$email]);
        return true;
    }
}

/*change login of a user*/
function change_login_db($login, $newlogin){
    include ('./model/connectDB.php');
    if(login_exists_db($newlogin)){
        return false;
    }else{
        $pdo->query("update User set login='$newlogin' where login='$login'");
        return true;
    }
}

/*change password of a user*/
function change_password_db($login,$password){
    include ('./model/connectDB.php');
    $pdo->query("update User set password='$password' where login='$login'");
}

/*delete a user from the DB*/
function delete_user_db($login){
    include ('./model/connectDB.php');
    $pdo->query("delete from User where login='$login'");
}
