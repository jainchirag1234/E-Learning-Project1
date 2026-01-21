<?php
include('./admininclude/header.php');
include('../dbConnection.php');

$course_price = 0; // Initialize $course_price

if (isset($_REQUEST['requpdate'])) {
    // Checking for empty fields 
    if (
        ($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "") ||
        ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_author'] == "") ||
        ($_REQUEST['course_duration_value'] == "") || ($_REQUEST['course_duration_unit'] == "") ||
        ($_REQUEST['course_price'] == "") || ($_REQUEST['course_original_price'] == "")
    ) {
        //msg displayed
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill all fields</div>';
    } else {
        // Assigning their values to variables
        $cid = $_REQUEST['course_id'];  // Add this line to define $cid
        $course_name = $_REQUEST['course_name'];
        $course_desc = $_REQUEST['course_desc'];
        $course_author = $_REQUEST['course_author'];
        $course_duration_value = $_REQUEST['course_duration_value'];
        $course_duration_unit = $_REQUEST['course_duration_unit'];
        $course_original_price = $_REQUEST['course_original_price'];
        $course_discount = isset($_REQUEST['course_discount']) ? floatval($_REQUEST['course_discount']) : 0;

        // Calculate discounted price before updating the database
        $course_price = $course_original_price - ($course_original_price * ($course_discount / 100));

        $course_image = $_FILES['course_img']['name'];
        $course_image_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../images/courseimg' . $course_image;
        move_uploaded_file($course_image_temp, $img_folder);

        $sql = "UPDATE course SET course_name='$course_name', course_desc='$course_desc', course_author='$course_author', course_img='$img_folder', course_duration_value='$course_duration_value', course_duration_unit='$course_duration_unit', course_price='$course_price', course_discount='$course_discount', course_original_price='$course_original_price' WHERE course_id = '$cid'";

        if ($conn->query($sql) == TRUE) {
            $msg = '<div class ="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
        } else {
            $msg = '<div class ="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to update</div>';
        }
    }
}
?>


<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Course Details</h3>
    <?php
    if (isset($_REQUEST['View'])) {
        $courseId = $_REQUEST['id'];
        $sql = "SELECT * FROM course WHERE course_id = $courseId ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
            <label for="course_id">Course Id</label>
            <input type="text" class="form-control" name="course_id" id="course_id" value="<?php if (isset($row['course_id'])) { echo $row['course_id'];} ?>" readonly >
        </div>
        <br />


        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" name="course_name" id="course_name" value="<?php if (isset($row['course_name'])) { echo $row['course_name'];} ?>">
        </div>
        <br />

        <div class="form-group">
            <label for="course_desc">Course Description</label>
            <textarea class="form-control" name="course_desc" id="course_desc" rows="2"><?php if (isset($row['course_desc'])) {echo $row['course_desc']; } ?></textarea>
        </div>
        <br />

        <div class="form-group">
            <label for="course_author">Author</label>
            <input type="text" class="form-control" name="course_author" id="course_author" value="<?php if (isset($row['course_author'])) {echo $row['course_author'];} ?>">
        </div>
        <br />
        <div class="form-group">
            <label for="course_duration">Course Duration</label>
            <div class="row">
                <div class="col-sm-6">
                    <select class="form-control" name="course_duration_value" id="course_duration_value">
                        <?php
                        // Assuming $numericValues is an array containing numeric values from 1 to 12
                        $numericValues = range(1, 12);

                        // Loop through the numeric values to generate options
                        foreach ($numericValues as $value) {
                            echo "<option value=\"$value\"" . ($value == $row['course_duration_value'] ? 'selected="selected"' : '') . ">$value</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <select class="form-control" name="course_duration_unit" id="course_duration_unit">
                        <?php
                        // Assuming $timeUnits is an array containing time units: day, week, month, year
                        $timeUnits = array("day", "week", "month", "year");

                        // Loop through the time units to generate options
                        foreach ($timeUnits as $unit) {
                            echo "<option value=\"$unit\"" . ($unit == $row['course_duration_unit'] ? 'selected="selected"' : '') . ">$unit</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="course_original_price">Course Original Price</label>
            <input type="text" class="form-control" name="course_original_price" id="course_original_price" value="<?php if (isset($row['course_original_price'])){echo $row['course_original_price']; } ?>">
        </div>
        <br />

        <div class="form-group">
            <label for="course_discount">Course Discount (%)</label>
            <input type="text" class="form-control" name="course_discount" id="course_discount" value="<?php if (isset($row['course_discount'])) {echo $row['course_discount']; } ?>">
        </div>
        <br />

        <div class="form-group">
            <label for="course_price">Course Selling Price</label>
            <input type="text" class="form-control" name="course_price" id="course_price" value="<?php if (isset($row['course_price'])) {echo $row['course_price'];} ?>" oninput="updateCoursePrice()">
        </div>
        <br />

        <div class="form-group">
            <label for="course_img">Course Image</label><br />
            <img src="<?php if (isset($row['course_img'])) {echo $row['course_img'];} ?>" alt="" class="img-thumbnail">
            <input type="file" class="form-control-file" name="course_img" id="course_img">
        </div>
        <br />

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="courses.php" class="btn btn-secondary">Close</a>
        </div>
        <br />
        <?php
        if (isset($msg) && isset($course_price)) {
            echo '<div class="alert alert-success col-sm-6 ml-5 mt-2">';
            echo 'Course Updated Successfully. Price: $' . $course_price . '</div>';
        } elseif (isset($msg)) {
            echo $msg;
        }
        ?>
    </form>
</div>

</div> <!--div row close from header-->
</div> <!--div container fluid close from header-->
<?php
include('./admininclude/footer.php');
?>
