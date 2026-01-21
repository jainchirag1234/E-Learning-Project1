<?php
include('./dbConnection.php');
// include('./mainInclude/header.php');
include('./index1.php');

?>
<!-- <div class="container-fluid bg-dark">
    <div class="row">
        <img src="./image/coursebanner.jpg" alt="courses" style="height: 300px; width: 100px; object-fit: 10px;">

    </div>
</div> -->
<!--End Course -->
<div class="container jumbotron mb-5">
    <div class="row">
        <div class="col-md-4">
            <h5 class="mb-3">If Already Registered !! Login</h5>
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
            
    <h3 class="text-center"> New Student !!Sign Up</h3>
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
        </div>
    </div>
</div>
<?php
    include('./contact.php');
  ?>
  <?php
    include('./footer1.php');
  ?>
  <!-- <?php
    include('./footer.php');
  ?> -->