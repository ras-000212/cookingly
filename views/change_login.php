<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Change login</title>
    <meta charset="utf-8">
</head>


<body>

    <?php include ('index.php?controle=users&action=head');?>

    <p>Current login: <?php echo $_SESSION['login'] ?></p>

    <form method="post" action="index.php?controle=controllers&action=profile">
        <label>New Login: <input type="text" name="new_login" placeholder="CookDelice" maxlength="12" autofocus required/></label>
        <input type="submit" value="Update your login"/>
    </form>
    <p><a href="index.php?controle=users&action=profile">Go to your profile page</a></p>

    <?php include ('index.php?controle=users&action=foot')?>

</body>
</html>
