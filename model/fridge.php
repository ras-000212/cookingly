<?php

function add_food_db($name_food,$nutriction_fact) {
     include ('./model/connectDB.php');
     if (existFood($name_food)){
          $sql = "INSERT INTO Food_Definition (name,nutriction_fact) values (?,?)";
          $pdo->preapare($sql)->execute([$name_food,$nutriction_fact]);
          return true;
     }
     else{
          return false;
     }
}

function exist_food_db($name_food) {
     include ('./model/connectDB.php');
     $stmt = $pdo->prepare("select * from Food_Definition where name=?");
     $stmt->execute([$name_food]);
     if ($stmt){
          return true;
     }
     else {
          return false;
     }
}

function get_user_foods_db($login) {
     include ('./model/connectDB.php');

     $res =$pdo->query("Select f.name as Name,food.quantity as Quantity, f.nutriction_fact as Nutriction from Food_Definition f,Food food,User u
     WHERE u.login='$login'
     AND u.Id_User=food.Id_User
     AND food.Id_Food=f.Id_Food");
     $foods = $res->fetchColumn();
     return $food;

}