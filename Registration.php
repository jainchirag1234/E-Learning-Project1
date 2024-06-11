<?php
session_start();
include("conn.php");

if (isset($_POST['register'])) {
    // Checking For Empty Fields
    if (empty($_POST['stu_name']) || empty($_POST['stu_email']) || empty($_POST['stu_pass']) || empty($_POST['stu_occ']) || empty($_POST['stu_dob']) || empty($_POST['stu_gender'])) {
        $msg = '<div class =" alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fileds</div>';
    } else {
        $stu_name = $_POST['stu_name'];
        $stu_email = $_POST['stu_email'];
        $stu_pass = $_POST['stu_pass'];
        $stu_occ = $_POST['stu_occ'];
        $stu_dob = $_POST['stu_dob'];
        $stu_gender = $_POST['stu_gender'];

        // Perform additional validation if needed

        // Handling Identity Card Photo upload
        $identityCardPhoto = $_FILES['identity_card_photo']['name'];
        $identityCardPhotoTmp = $_FILES['identity_card_photo']['tmp_name'];
        $uploadPath = "../uploads/identity_card_photos/";

        move_uploaded_file($identityCardPhotoTmp, $uploadPath . $identityCardPhoto);

        $sql = "INSERT INTO student (stu_name, stu_email, stu_pass, stu_occ, stu_dob, stu_gender, identity_card_photo) 
                VALUES ('$stu_name', '$stu_email', '$stu_pass', '$stu_occ', '$stu_dob', '$stu_gender', '$identityCardPhoto')";

        if ($conn->query($sql) == TRUE) {
            // Store relevant information in session variables
            $_SESSION['stu_id'] = $row['stu_id'];
            $_SESSION['stu_name'] = $row['stu_name'];
            $_SESSION['stu_email'] = $row['stu_email'];
            $_SESSION['stu_dob'] = $row['stu_dob'];
            $_SESSION['stu_occ'] = $row['stu_occ'];

           
            // Add other relevant session variables if needed

            session_regenerate_id(true);
            $_SESSION['is_login'] = true;
           
            // Add other relevant information to session if needed

            // Redirect to another page
            header("Location: index.php");
            exit();
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Register</div>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="./regstyle.css">
    
    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Bootstrap ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <!-- Font Awesome CSS  -->
    <link rel="stylesheet" href="../css/all.min.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <style>
       body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }

        header {
            background-color: #3498db; /* You can choose your preferred color */
            color: #fff;
            padding: 10px;
            box-sizing: border-box; /* Ensures padding is included in the total width */
            width: 100%;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 36;
        }
    </style>
</head>
<body>
    <header>
 <h1>Student Registeration</h1>
    </header>
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Student</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <i class="fas fa-user"></i>
        <label for="stu_name">Name</label>
            <input type="text" class="form-control" name="stu_name" id="stu_name">
        </div></br>

        <div class="form-group">
        <i class="fas fa-envelope"></i>
            <label for="stu_email">Email</label>
            <input type="email" class="form-control" name="stu_email" id="stu_email">
        </div></br>

        <div class="form-group">
        <i class="fas fa-key"></i>
            <label for="stu_pass">Password</label>
            <input type="text" class="form-control" name="stu_pass" id="stu_pass">
        </div></br>

        <div class="form-group">
        <i class="bi bi-briefcase-fill"></i>
            <label for="stu_occ">Occupation</label>
            <select class="form-control" name="stu_occ" id="stu_occ">
                <option value="Student">Student</option>
                <option value="Frontend Developer">Frontend Developer</option>
                <option value="Backend Developer">Backend Developer</option>
                <option value="Other">Other</option>
            </select>
        </div></br>

        <div class="form-group">
        <i class="fa-solid fa-calendar-days"></i>
            <label for="stu_dob">Date of Birth</label>
            <input type="date" class="form-control" name="stu_dob" id="stu_dob">
        </div></br>

        <div class="form-group">
        <i class="fa-solid fa-genderless"></i>
            <label for="stu_gender">Gender</label>
            <select class="form-control" name="stu_gender" id="stu_gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div></br>

        <div class="form-group">
        <i class="fa-solid fa-id-card-clip"></i>
            <label for="identity_card_photo">Identity Card Photo</label></br>
            <input type="file" class="form-control-file" name="identity_card_photo" id="identity_card_photo">
        </div></br>

        <div class="text-center">
        <button class="mx-auto d-block reg" name="register">Register</button>
            
        </div>

        <?php if(isset($msg)) { echo $msg; } ?>


        <a href="./login.php">Already Have An Account</a>

       

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