<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Boootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Font Awesome  CSS-->
    <link rel="stylesheet" href="css/all.min.css">
 
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
     <!-- Custom fonts -->
     <link rel="stylesheet" href="css/style.css">

     <script type="text/javascript" src="js/ajaxrequest.js"></script>

    <title>Learn Worlds</title>


    <style>
      .bottom-banner{
        color:#fff;
        padding:10px;
      }

      .stripe{
    background-image: linear-gradient(240deg, #ed213a, #93291e);
    padding:3rem;
    height: 13rem;
    margin-top: 4rem;
    transform: rotate(10deg);
    z-index: -5;
}

    </style>

</head>

<body>

<!--start navigation-->
<nav class="navbar navbar-expand-sm navbar-dark  pl-5 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Learn Worlds</a>
        <span class="navbar-text">
            Learn and Implement
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav custom-nav pl-5">
                <li class="nav-item custom-nav-item"><a href="index.php" class="nav-link"> Home</a></li>
                <li class="nav-item custom-nav-item"><a href="courses.php" class="nav-link">Courses</a></li>
                <li class="nav-item custom-nav-item"><a href="paymentstatus.php" class="nav-link">Payment Status</a></li>

                <?php
                session_start();

                // Check if the user is logged in
                if (isset($_SESSION['stu_name'])) {
                    // If logged in, display the "My Profile" and "Logout" links
                    echo '<li class="nav-item custom-nav-item"><a href="stu_include/StudentProfile.php" class="nav-link">My Profile</a></li>';
                    echo '<li class="nav-item custom-nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
                } else {
                    // If not logged in, display the "Signup" and "SignIn" links
                    echo '<li class="nav-item custom-nav-item"><a href="Registration.php" class="nav-link">SignUp</a></li>';
                    echo '<li class="nav-item custom-nav-item"><a href="login.php" class="nav-link data-bs-toggle= "modal" data-bs-target="stulogform">SignIn</a></li>';
                }
                ?>

                <li class="nav-item custom-nav-item"><a href="stu_include/stufeedback.php" class="nav-link">Feedback</a></li>
                <li class="nav-item custom-nav-item"><a href="#" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
</nav>
<!--End navigation-->