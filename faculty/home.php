<?php
include('./conn.php');
include('./common/header.php');

if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    // Access user details from session variables
    $stu_id = $_SESSION['stu_id'];
    $faculty_name = $_SESSION['faculty_name'];
    $faculty_email = $_SESSION['faculty_email'];
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Website </title>
    <link rel="stylesheet" type="text/css" href="#">

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Bootstrap ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <!-- Font Awesome CSS  -->
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="style2.css">

    <style>
          header {
            
            padding: 20px;
            text-align:center;
            margin-top: -300px;
        }

    </style>

</head>
<body>
    <div class="mx-5 mt-5 text-center ">
    <header>
        <h1>Welcome to Our Website <?php echo isset($faculty_name) ? $faculty_name : ''; ?></h1>
        <img src="e-learning 1.jpg" alt="Header Image" class="header-image">

        
    </header>
    </div>
    

    

   
</body>
</html>
