<?php
if (!isset($_SESSION)) {
    session_start();
}
include('./header.php');
include('./dbConnection.php');

$passmsg = ''; // Initialize the variable

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    // Access user details from session variables
    $stu_id = $_SESSION['stu_id'];
    $stu_name = $_SESSION['stu_name'];
    $stu_email = $_SESSION['stu_email'];
    $stu_gender = isset($_SESSION['stu_gender']) ? $_SESSION['stu_gender'] : '';
    $stu_occ = isset($_SESSION['stu_occ']) ? $_SESSION['stu_occ'] : '';
    $stu_dob = isset($_SESSION['stu_dob']) ? $_SESSION['stu_dob'] : '';
    $stu_img = isset($_SESSION['stu_img']) ? $_SESSION['stu_img'] : '';
}

if (isset($_POST['stuPassUpdateBtn'])) {
    if ($_POST['stuNewPass'] == "") {
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    } else {
        $stuEmail = $_POST["stuEmail"];
        $stuPass = $_POST['stuNewPass'];

        $sql = "UPDATE student SET stu_pass ='$stuPass' WHERE stu_email = '$stuEmail'";

        if ($conn->query($sql) === TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Password Updated Successfully</div>';
        } else {
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update Password</div>';
        }
    }
}
?>

<div class="col-sm-9 mt-5">
    <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="post">
                <div class="form-group">
                    <label for="stuEmail">Email</label>
                    <input type="email" class="form-control" name="stuEmail" id="stuEmail" value="<?php echo isset($stu_email) ? $stu_email : ''; ?>" readonly>
                </div><br>
                <div class="form-group">
                    <label for="inputnewpassword">New Password</label>
                    <input type="password" name="stuNewPass" class="form-control" placeholder="New Password" id="inputnewpassword" required>
                </div>

                <button type="submit" class="btn btn-primary mr-4 mt-4" name="stuPassUpdateBtn">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <?php echo $passmsg; ?>
            </form>
        </div>
    </div>
</div>

<?php
include('./footer.php');
?>
