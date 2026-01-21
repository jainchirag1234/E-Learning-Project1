<?php
if (!isset($_SESSION)) {
    session_start();
}

include("./header.php");
include("./dbConnection.php");

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    // echo "<script> location.href='./index.php'; </script>";
}

$sql = "SELECT * FROM student";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stuName = $row["stu_name"];
    $stuOcc = $row["stu_occ"];
    $stuImg = $row["stu_img"];
    $stuGender = $row["stu_gender"];
    $stuDOB = $row["stu_dob"];
}

if (isset($_POST['updateStuNameBtn'])) {
    if (empty($_POST['stuName'])) {
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role= "alert" > Fill All Fields</div>';
    } else {
        $stuName = $_POST["stuName"];
        $stuOcc = $_POST["stuOcc"];
        $stu_image = $_FILES['stuImg']['name'];
        $stuDOB = $_POST['stu_dob'];
        $stuGender = $_POST['stu_gender'];
        $stu_image_temp = $_FILES['stuImg']['tmp_name'];
        $img_folder = './images/stu/' . $stu_image;
        move_uploaded_file($stu_image_temp, $img_folder);
        $sql = "UPDATE student SET stu_name = '$stuName', stu_occ = '$stuOcc', stu_img = '$img_folder' WHERE stu_name = '$stuName'";
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
            <label for="StuName">Name</label>
            <input type="text" class="form-control" name="stuName" id="stuName" value="<?php if(isset($stuName)) { echo $stuName;} ?>">
        </div><br>
        <div class="form-group">
            <label for="StuEmail">Email</label>
            <input type="email" class="form-control" name="stuEmail" id="stuEmail" value="<?php if(isset($stuEmail)){echo $stuEmail;} ?>" >
        </div><br>
        <div class="form-group">
            <label for="stu_gender">Gender</label>
            <select class="form-control" name="stu_gender" id="stu_gender" value="<?php if(isset($stuGender)){ echo $stuGender;} ?>" >
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div></br>

        <div class="form-group">
            <label for="stu_occ">Occupation</label>
            <select class="form-control" name="stuOcc" id="stuOcc" value="<?php if(isset($stuOcc)) { echo $stuOcc;} ?>" >
                <option value="Student">Student</option>
                <option value="Frontend Developer">Frontend Developer</option>
                <option value="Backend Developer">Backend Developer</option>
                <option value="Other">Other</option>
            </select>
        </div></br>

        <div class="form-group">
            <label for="stu_dob">Date of Birth</label>
            <input type="date" class="form-control" name="stu_dob" id="stu_dob" value="<?php if(isset($stuDOB)){ echo $stuDOB;} ?>">
        </div></br>

        <div class="form-group">
            <label for="StuImg">Upload Image</label>
            <input type="file" class="form-control" name="stuImg" id="stuImg">
        </div><br>

        <button type="submit" class="btn btn-primary" name="updateStuNameBtn" >Update</button>
        
        <?php if(isset($passmsg)) { echo $passmsg;} ?>

    </form>
</div>

<?php
include('./footer.php');
?>