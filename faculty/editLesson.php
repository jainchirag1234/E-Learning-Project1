<?php
include('./common/header.php');
include('../dbConnection.php');
//Update
if(isset($_REQUEST['requpdate'])){
// Checking for empty fields 
if(($_REQUEST['lesson_id'] == "") || ($_REQUEST['lesson_name'] =="") ||
 ($_REQUEST['lesson_desc'] =="") ||($_REQUEST['course_id'] =="") || 
 ($_REQUEST['course_name'] =="")){
    //msg displayed
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill all fields</div>';
} else{
    //Assigning thier values to variable
    $lid =$_REQUEST['lesson_id'];
    $lname =$_REQUEST['lesson_name'];
    $ldesc =$_REQUEST['lesson_desc'];
    $cid =$_REQUEST['course_id'];
    $cname =$_REQUEST['course_name'];
    $link ='../lessonvid/'. $_FILES['lesson_link']['name'];
    $pdf = '';
    if (!empty($_FILES['lesson_pdf']['name'])) {
        $pdf = '../lessonpdf/' . $_FILES['lesson_pdf']['name'];
        move_uploaded_file($_FILES['lesson_pdf']['tmp_name'], $pdf);
    }
   
    $sql = "UPDATE lesson SET lesson_id='$lid',lesson_name='$lname',lesson_desc='$ldesc',course_id='$cid',course_name='$cname',lesson_link='$link' WHERE lesson_id = '$lid'";
    if($conn->query($sql) == TRUE){
        $msg='<div class ="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
    } else{
        $msg='<div class ="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to update</div>';
        
    }
}
}
?>

<div class="col-sm-6 mt-5  mx-3 jumbotron">
    <h3 class="text-center">Update Lesson Details</h3>

        <?php
       if(isset($_REQUEST['View'])  && isset($_REQUEST['id'])){
            $lessonId = $_REQUEST['id'];
            $sql = "SELECT * FROM lesson WHERE lesson_id = $lessonId ";
            $result = $conn->query($sql);
            if ($result) {
                 $row = $result->fetch_assoc();
                // var_dump($row);  // Add this line to debug
            } else {
                echo "Error executing the query: " . $conn->error;
            }
        }
            
        
        ?>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
            <label for="lesson_id">Lesson Id</label>
            <input type="text" class="form-control" name="lesson_id" id="lesson_id" value="<?php if(isset($row['lesson_id'])) { echo $row['lesson_id']; } ?>" readonly>
    </div>

        <div class="form-group">
            <label for="lesson_name">Lesson Name</label>
            <input type="text" class="form-control" name="lesson_name" id="lesson_name" value="<?php if(isset($row['lesson_name'])) { echo $row['lesson_name']; } ?>">
        </div>
        <br/>

        <div class="form-group">
            <label for="lesson_desc">Lesson Description</label>
            <textarea  class="form-control" name="lesson_desc" id="lesson_desc"  rows="2"><?php if(isset($row['lesson_desc'])) { echo $row['lesson_desc']; } ?></textarea>
        </div>
        <br/>

        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input type="text" class="form-control" name="course_id" id="course_id" value="<?php if(isset($row['course_id'])) { echo $row['course_id']; } ?>" readonly>
        </div>
        <br/>

        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" name="course_name" id="course_name" value="<?php if(isset($row['course_name'])) { echo $row['course_name']; } ?>" readonly>
        </div>
        <br/>

        <div class="form-group">
            <label for="lesson_link">Lesson Link</label>
            <div class="embed-responsive embed-responsive-16by9 ">
                <iframe class="embed-responsive-item" src="<?php if(isset($row['lesson_link'])) { echo $row['lesson_link']; } ?>" allowfullscreen ></iframe>
            </div>
            <input type="file" class="form-control-file" name="lesson_link" id="lesson_link" >
        </div>
        <br/>
        
        <div class="form-group">
    <label for="lesson_pdf">Lesson PDF</label><br/>
    <input type="file" class="form-control-file" name="lesson_pdf" id="lesson_pdf">
</div>

<?php
// Check if the form is submitted and the file has been uploaded
if (isset($_FILES['lesson_pdf']) && $_FILES['lesson_pdf']['error'] == UPLOAD_ERR_OK) {
    // Perform processing for the uploaded file
    $uploadedFile = $_FILES['lesson_pdf']['name'];
    $tempFile = $_FILES['lesson_pdf']['tmp_name'];

    // Move the file to the desired directory (you need to set the destination directory)
    $destinationDirectory = 'path/to/your/directory/';
    $destinationPath = $destinationDirectory . $uploadedFile;

    move_uploaded_file($tempFile, $destinationPath);

    echo "File uploaded successfully!";
}
?>

        

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="lessons.php" class="btn btn-secondary" >Close</a>
        </div>
        <br/>
        <?php
        if(isset($msg)){
        echo $msg;
        }
        ?>
    </form>
</div>

</div> <!--div row close from hrader-->
</div> <!--div container fluid close from header--> 
<?php
include('./common/footer.php');
?>
