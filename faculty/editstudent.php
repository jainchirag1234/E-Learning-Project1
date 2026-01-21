<?php
include('./common/header.php');
include('../dbConnection.php');

// Update
if(isset($_REQUEST['requpdate'])){
    // Checking for empty fields 
    if(empty($_REQUEST['stu_id']) || empty($_REQUEST['stu_name']) || empty($_REQUEST['stu_email']) || empty($_REQUEST['stu_pass']) || empty($_REQUEST['stu_occ']) || empty($_REQUEST['stu_dob']) || empty($_REQUEST['stu_gender'])){
        //msg displayed
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    } else {
        // Assigning their values to variables
        $sid = $_REQUEST['stu_id'];
        $sname = $_REQUEST['stu_name'];
        $semail = $_REQUEST['stu_email'];
        $spass = $_REQUEST['stu_pass'];
        $socc = $_REQUEST['stu_occ'];
        $stu_dob = $_REQUEST['stu_dob'];
        $stu_gender = $_REQUEST['stu_gender'];

        // Perform additional validation if needed

        // Handling Identity Card Photo upload
        $identityCardPhoto = $_FILES['identity_card_photo']['name'];
        $identityCardPhotoTmp = $_FILES['identity_card_photo']['tmp_name'];
        $uploadPath = "../uploads/identity_card_photos/";

        move_uploaded_file($identityCardPhotoTmp, $uploadPath . $identityCardPhoto);

        $sql = "UPDATE student SET stu_name='$sname',stu_email='$semail',stu_pass='$spass',stu_occ='$socc',stu_dob='$stu_dob',stu_gender='$stu_gender',identity_card_photo='$identityCardPhoto' WHERE stu_id = '$sid'";

        if($conn->query($sql) == TRUE){
            $msg='<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
        } else{
            $msg='<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to update</div>';
        }
    }
}

// Fetching student details for editing
if(isset($_REQUEST['View'])){
    $stu_Id = $_REQUEST['id'];
    $sql= "SELECT * FROM student WHERE stu_id = $stu_Id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Student Detail</h3>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="stu_id">ID</label>
            <input type="text" class="form-control" name="stu_id" id="stu_id" value="<?php if(isset($row['stu_id'])) { echo $row['stu_id']; } ?>" readonly>
        </div></br>

        <div class="form-group">
            <label for="stu_name">Name</label>
            <input type="text" class="form-control" name="stu_name" id="stu_name" value="<?php if(isset($row['stu_name'])) { echo $row['stu_name']; } ?>">
        </div></br>

        <div class="form-group">
            <label for="stu_email">Email</label>
            <input type="email" class="form-control" name="stu_email" id="stu_email" value="<?php if(isset($row['stu_email'])) { echo $row['stu_email']; } ?>">
        </div></br>

        <div class="form-group">
            <label for="stu_pass">Password</label>
            <input type="text" class="form-control" name="stu_pass" id="stu_pass" value="<?php if(isset($row['stu_pass'])) { echo $row['stu_pass']; } ?>">
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
            <input type="date" class="form-control" name="stu_dob" id="stu_dob" value="<?php if(isset($row['stu_dob'])) { echo $row['stu_dob']; } ?>">
        </div></br>

        <div class="form-group">
            <label for="stu_gender">Gender</label>
            <select class="form-control" name="stu_gender" id="stu_gender">
                <option value="Male" <?php if(isset($row['stu_gender']) && $row['stu_gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if(isset($row['stu_gender']) && $row['stu_gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if(isset($row['stu_gender']) && $row['stu_gender'] == 'Other') echo 'selected'; ?>>Other</option>
            </select>
        </div></br>

        <div class="form-group">
            <label for="identity_card_photo">Identity Card Photo</label>
            <input type="file" class="form-control-file" name="identity_card_photo" id="identity_card_photo">
        </div></br>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="requpdate" id="requpdate">Submit</button>
            <a href="students.php" class="btn btn-secondary">Close</a>
        </div>

        <?php if(isset($msg)) { echo $msg; } ?>

    </form>
</div>

<?php
include('./common/footer.php');
?>
