<?php
include('./common/header.php');
include('../dbConnection.php');

session_start(); // Start the session

if (isset($_POST['lessonSubmitBtn'])) {
    // Checking For Empty Fields
    if(empty($_POST['lesson_name']) || empty($_POST['lesson_desc']) ||  empty($_POST['course_name'])){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    } else {
        $lesson_name = $_POST['lesson_name'];
        $lesson_desc = $_POST['lesson_desc'];
        $course_name = $_SESSION['course_name']; // Retrieve course name from session

        // File upload handling
        $lesson_link = $_FILES['lesson_link']['name'];
        $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
        $link_folder = '../lessonvid/' . $lesson_link;
        move_uploaded_file($lesson_link_temp, $link_folder);
        
        $lesson_pdf = $_FILES['lesson_pdf']['name'];
        $lesson_pdf_temp = $_FILES['lesson_pdf']['tmp_name'];
        $pdf_folder = '../lessonpdf/' . $lesson_pdf;
        move_uploaded_file($lesson_pdf_temp, $pdf_folder);

        $course_id = $_POST['course_id']; // Add this line to retrieve course_id

        $sql = "INSERT INTO lesson(lesson_name, lesson_desc, lesson_link, lesson_pdf, course_id, course_name) 
        VALUES ('$lesson_name', '$lesson_desc', '$link_folder', '$pdf_folder', '$course_id', '$course_name')";

        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Lesson Added Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add Lesson</div>';
        }
    }
}

?>
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Lesson</h3>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" name="course_name" id="course_name" value="<?php if (isset($_SESSION['course_name'])) {
                                                                                                echo $_SESSION['course_name'];
                                                                                            } ?>" readonly>
        </div>
        <br />

        <div class="form-group">
            <label for="lesson_name">Lesson Name</label>
            <input type="text" class="form-control" name="lesson_name" id="lesson_name">
        </div>
        <br />

        <div class="form-group">
            <label for="lesson_desc">Lesson Desc</label>
            <input type="text" class="form-control" name="lesson_desc" id="lesson_desc">
        </div>
        <br />

        <div class="form-group">
            <label for="lesson_link">Lesson Video Link</label><br />
            <input type="file" class="form-control-file" name="lesson_link" id="lesson_link">
        </div>
        <br />

        <div class="form-group">
            <label for="lesson_pdf">Lesson PDF</label><br />
            <input type="file" class="form-control-file" name="lesson_pdf" id="lesson_pdf">
        </div>
        <br />

        <!-- Add a hidden input for course_id -->
        <input type="hidden" name="course_id" value="<?php if (isset($_SESSION['course_id'])) {
                                                        echo $_SESSION['course_id'];
                                                    } ?>">

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="lessonSubmitBtn" name="lessonSubmitBtn">Submit</button>
            <a href="lessons.php" class="btn btn-secondary">Close</a>
        </div>
        <br />
        <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
    </form>
</div>

</div> <!-- div row close from header -->
</div> <!-- div container fluid close from header -->
<?php
include('./common/footer.php');
?>
