<?php
/*verify the login and password entered*/
function user_exists ($login,$password){
    inlcude('/model/connectDB.php');
    if(login_exists($login)){
        $stmt = $pdo->query("select * from User where login='$login' and password = '$password'");
        if($stmt){
            return true;
        }
        return false;
    }
    return false;
}

/* verify if the login already exist in DB*/
function login_exists ($login){
    inlcude('/model/connectDB.php');
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
    inlcude('/model/connectDB.php');
    $stmt = $pdo->query("select * from User where email='$email'");
    if ($stmt){
        return true;
    }
    else{
        return false;
    }
}

/* add user in the DB */
function create_user($login,$password,$last_name,$first_name,$email) {
    inlcude('/model/connectDB.php');
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
    inlcude('/model/connectDB.php');
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
    inlcude('/model/connectDB.php');
    $pdo->query("update User set password='$password' where login='$login'");
}

/*delete a user from the DB*/
function delete_user($login){
    inlcude('/model/connectDB.php');
    $pdo->query("delete form User where login='$login'");
}