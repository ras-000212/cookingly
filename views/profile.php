<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Profile page</title>
    <meta charset="utf-8">
</head>


<body>

    <?php include ('./views/header.php');?>

    <h1>Welcome to your account page</h1>

    <p><a href="index.php?controle=users&action=change_login">Change your login</a></p>
    <p><a href="index.php?controle=users&action=change_password">Change your password</a></p>
    <button onclick="myFunction()">Delete your account</button>

    <p id="demo"></p>
    <br/>
    <p><a href="index.php?controle=users&action=fridge">Go to your fridge</a></p>
    <script>
    function myFunction() {
        var txt;
            if (confirm("Do you confirm the suppression of your account?","Confirmation")) {
                txt = "You pressed OK!";
                window.location.replace("index.php?controle=users&action=authentification");
            } else {
                txt = "You pressed Cancel!";
            }
            document.getElementById("demo").innerHTML = txt;
    }
    </script>

    <?php include ('./views/footer.php')?>

</body>
</html>
