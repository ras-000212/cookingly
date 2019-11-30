<?php $host = 'localhost';
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

function add_food($name_food,$nutriction_fact) {
     if (existFood($name_food)){
          $sql = "INSERT INTO Food_Definition (name,nutriction_fact) values (?,?)";
          $pdo->preapare($sql)->execute([$name_food,$nutriction_fact]);
          return true;
     }
     else{
          return false;
     }
}

function exist_food($name_food) {
     $stmt = pdo->prepare("select * from Food_Definition where name=?");
     $stmt->execute([$name_food]);
     if ($stmt){
          return true;
     }
     else {
          return false
     }
}