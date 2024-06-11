<?php
session_start();
include("conn.php");

if (isset($_POST["login"])) {
    $stu_name = $_POST['stu_name'];
    $stu_email = $_POST['stu_email'];
    $stu_pass = $_POST['password'];

    $sql = "SELECT * FROM student WHERE stu_name=? AND stu_email=? AND stu_pass=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $stu_name, $stu_email, $stu_pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            // Fetch additional information if needed
            $row = mysqli_fetch_assoc($result);

            // Store relevant information in session variables
            $_SESSION['stu_id'] = $row['stu_id'];
            $_SESSION['stu_name'] = $row['stu_name'];
            $_SESSION['stu_email'] = $row['stu_email'];
            $_SESSION['stu_dob'] = $row['stu_dob'];
            $_SESSION['stu_occ'] = $row['stu_occ'];

           
            // Add other relevant session variables if needed

            session_regenerate_id(true);
            $_SESSION['is_login'] = true;

            echo '<script>alert("Login successful!");</script>';
            header("Location: index.php");
            exit();
        } else {
            echo "Login failed. Please check your credentials.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in SQL statement preparation: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
        <!-- Bootstrap CSS  -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <!-- Bootstrap ICONS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

        <!-- Font Awesome CSS  -->
        <link rel="stylesheet" href="../css/all.min.css">

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">


</head>
<body>
<div id="form">
    <h1>Student Login</h1>
    <form action="login.php" method="post" id="stulogform">

        <i class="fas fa-user"></i>
        <label for="stu_name">Student Name:</label>
        <input type="text" name="stu_name" required><br><br>

        <i class="fas fa-envelope"></i>
        <label for="stu_email">Student Email:</label>
        <input type="email" name="stu_email" required><br><br>

        <i class="fas fa-key"></i>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <button class="custom-button" name="login">Login</button><br><br>
        <a href="./Registration.php">Create New Account</a>
    </form>
</div>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    <!--Font Awesome JS-->
        <script src="js/all.min.js"></script>

    <!--Custom JS-->
        <script type="text/Javascript" src="../js/custom.js"></script>

</body>
</html>
