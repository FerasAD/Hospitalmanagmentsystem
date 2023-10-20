<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login </title>
    <link rel="stylesheet" href="patientLoginStyle.css">
</head>
<body>
    <div class="container">
        <form action="loginQuary.php" method="post" class="form">
            <h2>Login</h2>
            <input type="text" name="Patient_ID" class="box" placeholder="Enter your Patient ID">
            <input type="email" name="Email" class="box" placeholder="Enter your Email">
            <input type="text" name="Postcode" class="box" placeholder="Enter your Postcode">
            <input type="password" name="Password" class="box" placeholder="Enter your Password">
            <input type="submit" value="Login"id= "submit" name="login">
            <p>* We ask you to Login with the correct credentials so that we verify that the person accessing  your account is you </p>
        </form>
        <div class="side">
            <img src="img/logo.png" alt="">
        </div>
    </div>
</body>
</html>