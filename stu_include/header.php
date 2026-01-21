<?php


$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name ="learning";

//Create Connection
$conn = new mysqli($db_host,$db_user,$db_password,$db_name);

//Check Connection
if($conn->connect_error){
    die("connection failed");
}




if(!isset($_SESSION)){
    session_start();
}

$stuLogEmail = "";

if(isset($_SESSION['stuEmail'])){
    $stuLogEmail = $_SESSION['stuEmail'];

    $sql = "SELECT stu_img FROM student WHERE stu_email = '$stuLogEmail'";
    $result = $conn->query($sql);

    if($result){
        $row = $result->fetch_assoc();
        $stu_img = $row['stu_img'];
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

        <!-- Bootstrap CSS  -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <!-- Bootstrap ICONS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

        <!-- Font Awesome CSS  -->
        <link rel="stylesheet" href="../css/all.min.css">

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

        <!-- Custom CSS-->     
        <link rel="stylesheet" href="../css/stu_style.css">
</head>
<body>
    <!--Top Navbar-->
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow " style="background-color: #225470;" >
        <a href="StudentProfile.php" class="navbar-brand col-sm-3 col-md-2 mr-0">E-Learning</a>
    </nav>

    <!--Slide Bar-->
    <div class="container-fluid mb-5" style="margin-top: 40px;" >
        <div class="row">
            <nav class="col-sm-7 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-3">
                            <img src="<?php echo $stu_img ?>" alt="studentimage" class="img-thumbnail rounded-circle" >
                        </li>

                        <li class="nav-item">
                            <a href="StudentProfile.php" class="nav-link">
                                <i class="fas fa-user"></i>
                                Profile <span class="sr-only" >(current)</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="myCourse.php" class="nav-link">
                                <i class="fab fa-accessible-icon"></i>
                                My Courses
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="stufeedback.php" class="nav-link">
                                <i class="fab fa-accessible-icon"></i>
                                Feedback
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="studentChangePass.php" class="nav-link">
                                <i class="fas fa-key"></i>
                                Change Password
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

</body>
</html>