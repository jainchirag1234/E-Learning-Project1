<?php
if(isset($_SESSION)){
    session_start();
}
include("./header.php");
include("./dbConnection.php");

if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    // Access user details from session variables
    $stu_id = $_SESSION['stu_id'];
    $stu_name = $_SESSION['stu_name'];
    $stu_email = $_SESSION['stu_email'];
}

$sql = "SELECT * FROM student";
$result = $conn->query($sql);
if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $stuName =$row["stu_name"];
}
if(isset($_REQUEST['submitfeedbackBtn'])){
    if($_REQUEST['f_content'] == ""){
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role= "alert" > Fill All Fields</div>';
    } else {
        $fcontent = $_REQUEST["f_content"];
        $sql = "INSERT INTO feedback (f_content, f_name, stu_id) VALUES ('$fcontent', '$stu_name' , '$stu_id')";
        
        if ($conn->query($sql) === TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Submitted Successfully</div>';
        } else {
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Error: ' . $conn->error . '</div>';
        }
        

        }
    }


?>
<div class="col-sm-6 mt-5">
    <form class="mx-5" method="POST" enctype="multipart/form-data" action="">
        <div class="form-group">
            <label for="stuId">Student Name</label>
            <input type="text" class="form-control" name="stu_name" id="stu_name" value="<?php if(isset($stu_name)) {echo $stu_name;} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="f_content">Write Feedback:</label>
            <textarea class="form-control" id="f_content" cols="30" rows="10" name="f_content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submitfeedbackBtn">Submit</button>
        <?php if(isset($passmsg)) {echo $passmsg;} ?>
    </form>
</div>

<?php
include('./footer.php');
?>