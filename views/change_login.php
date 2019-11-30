<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Change of login</title>
   <!-- <link rel="stylesheet" type="text/css" href="style.css"/> A DEFINIR-->
    <meta charset="utf-8">
</head>


<body>

    <?php include ('./header.php');?>

    <p>Current login: <?php echo $_SESSION['login'] ?></p>

    <form method="post" action="index.php?controle=users&action=change_login">
        <label>New Login: <input type="text" name="new_login" placeholder="CookDelice" maxlength="12" autofocus required/><label/>
        <input type="submit" value="Update your login"/>
    </form>
    <p><a href="profile.php">Go to your profile page</a></p>

    <?php include ('./footer.php')?>

</body>
</html>