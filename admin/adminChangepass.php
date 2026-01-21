<?php
if (!isset($_SESSION)) {
    session_start();
}
include('./adminInclude/header.php');
include('../dbConnection.php');
if (isset($_SESSION['is_admin_login'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page or handle the situation as needed
    // echo "<script> location.href='../admin/index.php';</script>";
}

$passmsg = '';  // Initializing $passmsg to an empty string

if (isset($_REQUEST['adminPassUpdatebtn'])) {
    // Message displayed if required 
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
} else {
    // Check if $username is defined before using it
    if (isset($username)) {
        $sql = "SELECT * FROM admin WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $pass = $_REQUEST['pass'];
            $sql = "UPDATE admin SET password = '$pass' WHERE username='$username'";

            if ($conn->query($sql) == TRUE) {
                // Display success message
                $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
            }
        }
    } else {
        // Handle the case where $username is not defined
        // You might want to redirect the user or display an error message
    }
}
?>
<div class="col-sm-9 mt-5">
    <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="post">
                <div class="form-group">
                    <label for="name">Username: </label>
                    <input type="text" name="user" id="user" placeholder="enter your name" value="<?php echo isset($username) ? $username : ''; ?>">
                </div></br>

                <div class="form-group">
                    <label for="Password">Password: </label>
                    <input type="password" name="pass" id="pass" placeholder="enter your password" required>
                </div></br>

                <button type="submit" class="btn btn-danger mr-4 mt-4" name="adminPassUpdatebtn">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <?php echo $passmsg; ?>
            </form>
        </div>
    </div>
</div>

<?php
include('./admininclude/footer.php');
?>
