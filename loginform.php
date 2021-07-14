<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-box">
    <div class="form">
        <form method="post" name="login" action="owner/home-owner.php";>
        <table border ="1">
        <tr><th colspan="2">Login</th></tr>
        <tr><td>Username</td>
            <td><input type="text" name="username" size="30"></td></tr>
        <tr><td>Password</td>
            <td><input type="password" name="password" size="30"></td></tr>
        <tr><td>&nbsp</td>
            <td><input type="submit" name="login" value="Login"></td></tr>
        </table>
        </form>
    </div>
</div>

<?php /*
    if (isset($_POST["login"])) 
        include "owner/home-owner.php"; */
?>
</body>
</html>