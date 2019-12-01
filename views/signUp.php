<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
</head>

<body>

    <?php include ('index.php?controle=controllers&action=header');?>

    <form method="post" action="index.php?controle=controllers&action=sign_up">
        <fieldset>
            <legend>Sign Up</legend>
            <label>First Name: <input type="text" name="first_name" placeholder="Cookingly" maxlength="30" autofocus required/></label>
            </br>
            <label>Last Name: <input type="text" name="last_name" placeholder="Delicious" maxlength="30" required/></label> 
            </br>
            <label>Email: <input type="email" name="email" placeholder="Cookingly@delicious.com" maxlength="50" required/></label> 
            </br>
            <label>Login: <input type="text" name="login" placeholder="CookDelice" maxlength="12" autofocus required/></label> 
                </br>
            <label>Password: <input type="password" name="password" maxlength="8" required/></label> 
            </br>
            <label>Confirm Password: <input type="password" name="password_confirm" maxlength="8" required/></label> 
            </br>
            <input type="submit" value="Welcome to your Kitchen!" />
        </fieldset>
    </form>

    <?php include ('index.php?controle=controllers&action=footer')?>

</body>
</html>
