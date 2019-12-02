<?php
/*function that connect*/
function authentification(){
    include ("./model/users.php");
    $login=!empty($_POST['login']) ? $_POST['login'] : NULL;
    $password=!empty($_POST['password']) ? $_POST['password'] : NULL;

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
        $cost=5;

        if(login_exists_db($login)){
            $_SESSION['error']='login already use';
            echo('login already use');
            
        }
        elseif(email_exists_db($email)){
            $_SESSION['error']='email already use';
            echo('email already use');
        }
        elseif($password !== $password_confirm){
            $_SESSION['error']='not the same password';
            echo('not the same password');
        }else{
            $password= password_hash($password,PASSWORD_BCRYPT,["cost"=>$cost]);
            create_user_db($login,$password,$last_name,$first_name,$email);
            require("./views/fridge.php");
        }
    }

}

/*sign Out*/
function signOut(){
    include ("./model/users.php");
    session_destroy();
    require ("./views/home.php");
}

/*open the fridge page*/
function fridge(){
     include ("./model/fridge.php");
     require ("./views/fridge.php");
}

/*delete your account*/
function delete(){
    include ("./model/users.php");
    $login = $_POST['login'];
    delete_user_db($login);
    require("./views/home.php");
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

/*change login */
function change_login(){
    include ("./model/users.php");
    $login=!empty($_POST['login']) ? $_POST['login'] : NULL;
    $new_login=!empty($_POST['new_login']) ? $_POST['new_login'] : NULL;
    if (count($_POST)==0){
        require ("./views/change_login.php");
    }else{
        if(!change_login_db($login, $new_login)){
            $_SESSION['error_login']='login already used';
        }
        else{
            require ("./views/profile.php");
        }
    }      
}
/*add food to storage */
function add_food(){
    include ("./model/users.php");
     $login=$_SESSION['login'];
    
    $food_name=!empty($_POST['list_food']) ? $_POST['list_food'] : NULL;
    $quantity=!empty($_POST['quantity-add']) ? $_POST['quantity-add'] : NULL;
    
    $_SESSION['error']=$food_name;
    
    if($food_name==null){
        $_SESSION['error']='you can not add : you do not select the food ';
     }
    elseif($quantity==null){
        $_SESSION['error']='you can not add : you do not put the quantity ';
    }
    elseif($quantity>0){
        add_food_db($login,$food_name,$quantity);
    }
 require ("./views/fridge.php");

}

/*add food to storage */
function remove_food(){
    include ("./model/users.php");
     $login=$_SESSION['login'];
    
    $food_name=!empty($_POST['list_food_remove']) ? $_POST['list_food_remove'] : NULL;
    $quantity=!empty($_POST['quantity-remove']) ? $_POST['quantity-remove'] : NULL;
    
    $_SESSION['error']=$food_name;
    
    if($food_name==null){
        $_SESSION['error']='you can not remove : you do not select the food ';
     }
    elseif($quantity==null){
        $_SESSION['error']='you can not remove : you do not put the quantity ';
    }
    elseif($quantity>0){
        remove_food_db($login,$food_name,$quantity);
    }
 require ("./views/fridge.php");

}

/*change the password*/
function change_password(){
    include ("./model/users.php");
    require ("./views/change_password.php");
    $cost=5;
    $login=$_SESSION['login'];
    $password=$_POST['password'];
    $new_password=$_POST['new_password'];
    if (!user_exists_db($login,$password)){
        $_SESSION['error']="the password is wrong";
        require ("./views/change_password.php");
        return false;
    }
    if($password !== $password_confirm){
        $_SESSION['error_password']='not the same password';
    }else{
        $hash=password_hash($new_password,PASSWORD_BCRYPT,["cost"=>$cost]);
        change_password_db($login,$hash);
    }
}

