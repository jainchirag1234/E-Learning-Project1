<?php
include('./common/header.php');
include('../dbConnection.php');

if(isset($_POST['newStuSubmitBtn'])){
    // Checking For Empty Fields
    if(($_POST['stu_name'] == "") || ($_POST['stu_email'] == "") || ($_POST['stu_pass'] == "") || ($_POST['stu_occ'] == "") || ($_POST['stu_dob'] == "") || ($_POST['stu_gender'] == "")){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
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

        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Student Added Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add Student</div>';
        }
    }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Student</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="stu_name">Name</label>
            <input type="text" class="form-control" name="stu_name" id="stu_name">
        </div></br>

        <div class="form-group">
            <label for="stu_email">Email</label>
            <input type="email" class="form-control" name="stu_email" id="stu_email">
        </div></br>

        <div class="form-group">
            <label for="stu_pass">Password</label>
            <input type="text" class="form-control" name="stu_pass" id="stu_pass">
        </div></br>

        <div class="form-group">
            <label for="stu_occ">Occupation</label>
            <select class="form-control" name="stu_occ" id="stu_occ">
                <option value="Student">Student</option>
                <option value="Frontend Developer">Frontend Developer</option>
                <option value="Backend Developer">Backend Developer</option>
                <option value="Other">Other</option>
            </select>
        </div></br>

        <div class="form-group">
            <label for="stu_dob">Date of Birth</label>
            <input type="date" class="form-control" name="stu_dob" id="stu_dob">
        </div></br>

        <div class="form-group">
            <label for="stu_gender">Gender</label>
            <select class="form-control" name="stu_gender" id="stu_gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div></br>

        <div class="form-group">
            <label for="identity_card_photo">Identity Card Photo</label></br>
            <input type="file" class="form-control-file" name="identity_card_photo" id="identity_card_photo">
        </div></br>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="newStuSubmitBtn" id="newStuSubmitBtn">Submit</button>
            <a href="students.php" class="btn btn-secondary">Close</a>
        </div>

        <?php if(isset($msg)) { echo $msg; } ?>

    </form>
</div>

<?php
include('./common/footer.php');
?>
