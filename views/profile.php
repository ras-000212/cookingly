<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Profile page</title>
   <!-- <link rel="stylesheet" type="text/css" href="style.css"/> A DEFINIR-->
    <meta charset="utf-8">
</head>


<body>

    <?php include ('./header.php');?>

    <h1>Welcome to your account page</h1>

    <p><a href="./change_login.php">Change your login</a></p>
    <p><a href="./change_password.php">Change your password</a></p>
    <button onclick="myFunction()">Delete your account</button>

    <p id="demo"></p>
    <br/>
    <p><a href="./fridge.php">Go to your fridge</a></p>
    <script>
    function myFunction() {
        var txt;
            if (confirm("Do you confirm the suppression of your account?","Confirmation")) {
                txt = "You pressed OK!";
                window.location.replace("./delete.php");
            } else {
                txt = "You pressed Cancel!";
            }
            document.getElementById("demo").innerHTML = txt;
    }
    </script>

    <?php include ('./footer.php')?>

</body>
</html>