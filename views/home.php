<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
</head>


<body>

    <?php include ('./header.php');?>

    <form method="post" action="index.php?controle=controllers&action=signIn">
        <fieldset>
            <legend>Sign In</legend>
            <label for="login">Login</label> : <input type="text" name="login" id="login" placeholder="Cookingly" maxlength="12" autofocus required/>
            </br>
            <label for="password">Password</label> : <input type="password" name="password" id="password" maxlength="8" required/>
            </br>
            <input type="submit" value="Let's Cook!" />
        </fieldset>
    </form>
    <a href="index.php?controle=controllers&action=sign_up">Create Account</a>

    <?php include ('./footer.php')?>

</body>
</html>