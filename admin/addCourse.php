<?php
include('./admininclude/header.php');
include('../dbConnection.php');

$course_price = 0; // Initialize $course_price

if(isset($_POST['courseSubmitBtn'])){
    //Checking For Empty Fields
    if(($_POST['course_name'] == "") || ($_POST['course_desc'] == "") || ($_POST['course_author'] == "") || ($_POST['course_duration_value'] == "") || ($_POST['course_duration_unit'] == "") ||  ($_POST['course_price'] == "") || ($_POST['course_original_price'] == "")){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    } else {
        $course_name = $_POST['course_name'];
        $course_desc = $_POST['course_desc'];
        $course_author = $_POST['course_author'];
        $course_duration_value = $_POST['course_duration_value'];
        $course_duration_unit = $_POST['course_duration_unit'];
        $course_original_price = $_POST['course_original_price'];
        $course_discount = isset($_POST['course_discount']) ? floatval($_POST['course_discount']) : 0;

        // Calculate discounted price before inserting into the database
        $course_price = $course_original_price - ($course_original_price * ($course_discount / 100));

        $course_image = $_FILES['course_img']['name'];
        $course_image_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../images/courseimg' . $course_image;
        move_uploaded_file($course_image_temp, $img_folder);

        $sql = "INSERT INTO course (course_name, course_desc, course_author, course_img, course_duration_value, course_duration_unit, course_price, course_discount, course_original_price) VALUES ('$course_name', '$course_desc', '$course_author', '$img_folder', '$course_duration_value', '$course_duration_unit', '$course_price','$course_discount', '$course_original_price')";

        if ($conn->query($sql) == TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Course Added Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add Course</div>';
        }

       
        // Clear other form fields
        $_POST['course_name'] = '';
        $_POST['course_desc'] = '';
        $_POST['course_author'] = '';
        $_POST['course_duration_value'] = '';
        $_POST['course_duration_unit'] = '';
        $_POST['course_original_price'] = '';
        $_POST['course_discount'] = ''; // Clear course_discount
        $_POST['course_price'] = ''; // Clear course_price
    }
}




?>

<div class="col-sm-6 mt-5  mx-3 jumbotron">
    <h3 class="text-center">Add New Course</h3>
    <form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
    <label for="course_name">Course Name</label>
    <input type="text" class="form-control" name="course_name" id="course_name" value="<?php if(isset($row['course_name'])) { echo $row['course_name']; } ?>">

</div>

        <br/>

        <div class="form-group">
            <label for="course_desc">Course Description</label>
            <textarea  class="form-control" name="course_desc" id="course_desc"  rows="2"></textarea>
        </div>
        <br/>

        <div class="form-group">
            <label for="course_author">Author</label>
            <input type="text" class="form-control" name="course_author" id="course_author">
        </div>
        <br/>

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
                    echo "<option value=\"$value\">$value</option>";
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
                    echo "<option value=\"$unit\">$unit</option>";
                }
                ?>
            </select>
        </div>
    </div>
</div>



        <div class="form-group">
            <label for="course_original_price">Course Original Price</label>
            <input type="text" class="form-control" name="course_original_price" id="course_original_price">
        </div>
        <br/>

        <div class="form-group">
            <label for="course_discount">Course Discount (%)</label>
            <input type="text" class="form-control" name="course_discount" id="course_discount" value="<?php if(isset($_POST['course_discount'])) { echo $_POST['course_discount']; } ?>">
        </div></br>


        <div class="form-group">
            <label for="course_price">Course Selling Price</label>
            <input type="text" class="form-control" name="course_price" id="course_price" id="course_discount" value="<?php if(isset($_POST['course_discount'])) { echo $_POST['course_discount']; } ?>" oninput="updateCoursePrice()"   >
        </div>
        <br/>

        <div class="form-group">
            <label for="course_img">Course Image</label><br/>
            <input type="file" class="form-control-file" name="course_img" id="course_img">
        </div>
        <br/>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
            <a href="courses.php" class="btn btn-secondary" >Close</a>
        </div>
        <br/>
        <!-- Add this new div to display discounted price along with course price -->
        <div class="mt-3">
            <?php
            if(isset($msg) && isset($course_price)){
                echo '<div class="alert alert-success col-sm-6 ml-5 mt-2">';
                echo 'Course Added Successfully. Price: $'.$course_price.'</div>';
            } elseif(isset($msg)) {
                echo $msg;
            }
            ?>
        </div>
    </form>
</div>

</div> <!--div row close from hrader-->
</div> <!--div container fluid close from header--> 
<?php
include('./admininclude/footer.php');
?>