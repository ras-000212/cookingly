<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Fridge</title>
    <meta charset="utf-8">
</head>


<body>

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
            include ('./model/connectDB.php');

            $res =$pdo->query("Select f.name as Name,food.quantity as Quantity, f.nutriction_fact as Nutriction from Food_Definition f,Food food,User u
            WHERE u.login='$login'
            AND u.Id_User=food.Id_User
            AND food.Id_Food=f.Id_Food");
            if($row=$res->fetch() != null ){
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
        <h1>Ajout d'aliments</h1>	
    </div>

    <?php include ('./views/footer.php');?>

</body>
</html>
