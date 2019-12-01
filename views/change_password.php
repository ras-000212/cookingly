<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Change your password</title>
    <meta charset="utf-8">
</head>

<body>
<?php include ('./views/header.php');?>

    <form method="post" action="index.php?controle=controllers&action=sign_up">
        <fieldset>
            <legend>Change password</legend>
            <label>Password: <input type="password" name="password" maxlength="8" required/></label> 
            </br>
            <label>New Password: <input type="new_password" name="new_password" maxlength="8" required/></label> 
            </br>
            <label>Confirm Password: <input type="new_password_confirm" name="new_password_confirm" maxlength="8" required/></label> 
            </br>
            <input type="submit" value="Confirm" />
        </fieldset>
    </form>

    <?php include ('./views/footer.php')?>

</body>
</html>
