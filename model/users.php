<?php
/*verify the login and password entered*/
function user_exists_db ($login,$password){
    include ('./model/connectDB.php');
    $res = $pdo->query("Select * from User where login = '$login'");
    if($row = $res->fetch()){
        if(password_verify($password, $row['password'])){
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
    if ($res = $stmt->fetch()){
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
    if(login_exists_db($login) or email_exists_db($email)){
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
        $sql = "update User set login=? where login=?";
        $pdo->prepare($sql)->execute([$newlogin,$login]);
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
     $sql = "delete from User where login=?";
     $pdo->prepare($sql)->execute([$login]);
}

/* add food to the fridge of the user*/
function add_food_db($login,$food_name,$quantity){
    include('./model/connectDB.php');
    $IdUser=getUserId($login);
    $IdFood=getFoodId($food_name);
    
    $sql ="Select quantity from Food where Id_Food='$IdFood' and Id_User='$IdUser'";
    $res=$pdo->query($sql);
     if($row = $res->fetch()){
        $pdo->query("UPDATE Food set quantity=quantity+'$quantity' where Id_User='$IdUser' and Id_Food='$IdFood'");
     }
    else{
        $pdo->query("INSERT INTO Food (Id_Food,Id_User,Quantity) values('$IdFood','$IdUser','$quantity')");
        }
    }

/* remove food to the fridge of the user*/
function remove_food_db($login,$food_name,$quantity){
    include('./model/connectDB.php');
    $IdUser=getUserId($login);
    $IdFood=getFoodId($food_name);
 
    $sql ="Select quantity from Food where Id_Food='$IdFood' and Id_User='$IdUser'";
    $res=$pdo->query($sql);
     if($row = $res->fetch()){
         $row = $res->fetch();
         
         if($row['quantity']>$quantity){
              $pdo->query("UPDATE Food set quantity=quantity-'$quantity' where Id_User='$IdUser' and Id_Food='$IdFood'");
         }
         else{
             $pdo->query("DELETE From Food where Id_User='$IdUser' and Id_Food='$IdFood'");
         }
     }
    }


/*get food Id */
function getfoodId($food_name){
    include('./model/connectDB.php');
    $res=$pdo->query("Select Id_Food from Food_Definition where name ='$food_name'");
    $row=$res->fetch();  
    return $row['Id_Food'];
   }

/*get user Id */
function getUserId($login){
    include('./model/connectDB.php');
    $res=$pdo->query("Select Id_User from User where login='$login'");
     $row=$res->fetch(); 
    return $row['Id_User'];
   }
