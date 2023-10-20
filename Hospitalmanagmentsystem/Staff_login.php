<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>
    <link rel="stylesheet" href="staffLogin.css">
</head>
<body>
    <div class="container">
        <form action="staffLogin_query.php" method="post" class="form">
            <h2> Staff Login</h2>
            <input type="text" name="Staff_ID" class="box" placeholder="Enter Staff ID">
            <input type="password" name="Password" class="box" placeholder="Enter Password">
            <input type="submit" value="Login" id="submit" name="loginstaff">
        </form>
        <div class= "side">
            <img src="img/stafflogo.jpeg" alt="">
        </div>
    </div>
</body>
</html>
