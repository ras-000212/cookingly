<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Change login</title>
    <meta charset="utf-8">
</head>


<body>

    <?php include ('./views/header.php');?>

    <p>Current login: <?php echo $_SESSION['login'] ?></p>

    <form method="post" action="index.php?controle=controllers&action=change_login">
        <label>New Login: <input type="text" name="new_login" placeholder="CookDelice" maxlength="12" autofocus required/></label>
        <input type="submit" value="Update your login"/>
    </form>
    <p><a href="index.php?controle=controllers&action=profile">Go to your profile page</a></p>

    <?php include ('./views/footer.php')?>

</body>
</html>
