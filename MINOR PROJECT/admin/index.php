<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div id="form">
    <h1>Admin Login</h1>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="name">Username: </label>
            <input type="text" name="user" id="user" placeholder="enter your name" required><br><br>
            <i class="bx bxs-user"></i>
        </div>
        <div class="form-group">
            <label for="Password">Password: </label>
            <input type="password" name="pass" id="pass" placeholder="enter your password" required><br><br>
        </div>

        
         
        <button class="custom-button" name="submit" >Login</button>


    </form>
</div>
</body>
</html>
