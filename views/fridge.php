<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    	<title>Fridge</title>
    	<meta charset="utf-8">
</head>


<body>
    <?php
    $host ='localhost';
$db ='galiixy';
$user='galiixy';
$pass='Jobslpxi';
$charset='utf8mb4';
$dsn ="mysql:host=$host;dbname=$db;charset=$charset";
$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES =>false,
];
try {
	$pdo = new PDO($dsn,$user,$pass,$options);
} catch(\PDOException $e){
	throw new \PDOException($e->getMessage(),(int)$e->getCode());
}

?>

    <?php include ('./views/header.php');?>

    <div id="storage"> 
        <table align="left" border="1px" style ="width:300px; line-height:30px;">
                <tr>
                    <th colspan=3> <h2>Fridge</h2></th>
                </tr>
                <t>
                    <th>Food</th>
                <th>Nutriction Fact</th>
                <th>Quantity </th>
            </t>

        <?php
            $login=$_SESSION['login'];

            $res =$pdo->query("Select f.name as Name,food.quantity as Quantity, f.nutriction_fact as Nutriction from Food_Definition f,Food food,User u
            WHERE u.login='$login'
            AND u.Id_User=food.Id_User
            AND food.Id_Food=f.Id_Food");
            if($row=$res->fetch()){
                do{?>
                <tr>
                    <td> <?php echo $row['Name'] ?> </td>
                    <td> <?php echo $row['Nutriction'] ?> </td>
                    <td> <?php echo $row['Quantity'] ?> </td>
                </tr>
                <?php }	while($row=$res->fetch());
                } else{?>
                <tr>
                <td colspan=3> No food here ! Please add some food !</td>
                </tr> <?php }?>
        </table>
    </div> 
    <div id="add">
        <h3>Add food</h3>
	<form method="post" action="index.php?controle=controllers&action=add_food">
		<?php $res =$pdo->query("Select Count(Id_Food) as count from Food_Definition");
			$row=$res->fetch();?>
		<label for="select-food">Choose an aliment to add<br></label>
		<select name="list_food" id="select-food" >
			<option value="">--Please choose a food--</option>
			<?php $res=$pdo->query("Select Name from Food_Definition");
			while($row=$res->fetch()){ ?>
				<option value="<?php echo $row['Name']?>"><?php echo $row['Name']?></option>
			<?php } ?>
		</select> 
		<input type="number" name="quantity-add" placeholder="quantity to add">
		<input type="submit" value="Add food to your storage!">
	</form>    
    </div>
	
    <div id="remove">
        <h3>Remove food</h3>
	<form method="post" action="index.php?controle=controllers&action=remove_food">
		<?php $res =$pdo->query("Select Count(Id_Food) as count from Food_Definition");
			$row=$res->fetch();?>
		<label for="select-food_remove">Choose an aliment to remove <br></label>
		<select name="list_food_remove" id="select-food" >
			<option value="">--Please choose a food--</option>
			<?php $res=$pdo->query("Select Name from Food_Definition");
			while($row=$res->fetch()){ ?>
				<option value="<?php echo $row['Name']?>"><?php echo $row['Name']?></option>
			<?php } ?>
		</select> 
		<input type="number" name="quantity-remove" placeholder="quantity to remove">
		<input type="submit" value="Remove food to your storage!">
	</form>    
    </div>
	
    <?php include ('./views/footer.php');?>

</body>
</html>
