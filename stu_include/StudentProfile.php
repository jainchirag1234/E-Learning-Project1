<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    // Access user details from session variables
    $stu_id = $_SESSION['stu_id'];
    $stu_name = $_SESSION['stu_name'];
    $stu_email = $_SESSION['stu_email'];
    $stu_gender = isset($_SESSION['stu_gender']) ? $_SESSION['stu_gender'] : '';
    $stu_occ = isset($_SESSION['stu_occ']) ? $_SESSION['stu_occ'] : '';
    $stu_dob = isset($_SESSION['stu_dob']) ? $_SESSION['stu_dob'] : '';
    $stu_img = isset($_SESSION['stu_img']) ? $_SESSION['stu_img'] : '';
}


include("./header.php");
include("./dbConnection.php");

if (isset($stu_id)) {
    $sql = "SELECT * FROM student WHERE stu_id = $stu_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stuId = $row["stu_id"];
        $stuName = $row["stu_name"];
        $stuEmail = $row["stu_email"];
        $stuOcc = $row["stu_occ"];
        $stuImg = $row["stu_img"];
        $stuGender = $row["stu_gender"];
        $stuDOB = $row["stu_dob"];
    }
}


if (isset($_POST['updateStuNameBtn'])) {
    if (empty($_POST['stuName'])) {
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role= "alert" > Fill All Fields</div>';
    } else {
        $stuName = $_POST["stuName"];
        $stuEmail = $_POST["stuEmail"];
        $stuOcc = $_POST["stu_occ"];
        $stu_image = $_FILES['stuImg']['name'];
        $stuDOB = $_POST['stu_dob'];
        $stuGender = $_POST['stu_gender'];
        $stu_image_temp = $_FILES['stuImg']['tmp_name'];
        $img_folder = './images/stu/' . $stu_image;
        move_uploaded_file($stu_image_temp, $img_folder);

       

        $sql = "UPDATE student SET stu_name = '$stuName', stu_occ = '$stuOcc', stu_img = '$img_folder', stu_gender='$stuGender', stu_dob='$stuDOB', stu_email='$stuEmail' WHERE stu_id='$stu_id'";

        if ($conn->query($sql) === TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role= "alert" > Update Successfully </div>';
        } else {
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role= "alert" > Unable to Update </div>';
        }
    }
}
?>

<div class="col-sm-6 mt-5">
    <form action="" class="mx-5" method="POST" enctype="multipart/form-data" >
        <div class="form-group">
            <i class="fas fa-user"></i>
            <label for="StuName">Name</label>
            <input type="text" class="form-control" name="stuName" id="stuName" value="<?php echo isset($stu_name) ? $stu_name : ''; ?>">
        </div><br>

        <div class="form-group">
            <i class="fas fa-envelope"></i>
            <label for="StuEmail">Email</label>
            <input type="email" class="form-control" name="stuEmail" id="stuEmail" value="<?php echo isset($stu_email) ? $stu_email : ''; ?>" readonly >
        </div><br>

        <div class="form-group">
    <i class="fa-solid fa-genderless"></i>
    <label for="stu_gender">Gender</label>
    <select class="form-control" name="stu_gender" id="stu_gender">
        <option value="Male" <?php echo (isset($stu_gender) && $stu_gender == 'Male') ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo (isset($stu_gender) && $stu_gender == 'Female') ? 'selected' : ''; ?>>Female</option>
        <option value="Other" <?php echo (isset($stu_gender) && $stu_gender == 'Other') ? 'selected' : ''; ?>>Other</option>
    </select>
</div><br>


<div class="form-group">
    <i class="bi bi-briefcase-fill"></i>
    <label for="stu_occ">Occupation</label>
    <select class="form-control" name="stu_occ" id="stu_occ">
        <option value="Student" <?php echo (isset($stu_occ) && $stu_occ == 'Student') ? 'selected' : ''; ?>>Student</option>
        <option value="Frontend Developer" <?php echo (isset($stu_occ) && $stu_occ == 'Frontend Developer') ? 'selected' : ''; ?>>Frontend Developer</option>
        <option value="Backend Developer" <?php echo (isset($stu_occ) && $stu_occ == 'Backend Developer') ? 'selected' : ''; ?>>Backend Developer</option>
        <option value="Other" <?php echo (isset($stu_occ) && $stu_occ == 'Other') ? 'selected' : ''; ?>>Other</option>
    </select>
</div><br>


        <div class="form-group">
            <i class="fa-solid fa-calendar-days"></i>
            <label for="stu_dob">Date of Birth</label>
            <input type="date" class="form-control" name="stu_dob" id="stu_dob" value="<?php echo isset($stu_dob) ? $stu_dob : ''; ?>">
        </div></br>

        <div class="form-group">
            <i class="fa-solid fa-id-card-clip"></i>
            <label for="stuImg">Upload Image</label>
            <input type="file" class="form-control" name="stuImg" id="stuImg" accept="image/*">
        </div><br>


        <button type="submit" class="btn btn-primary" name="updateStuNameBtn" >Update</button>
        
        <?php if(isset($passmsg)) { echo $passmsg;} ?>

    </form>
</div>

<?php
include('./footer.php');
?>
