<?php
session_start();
include('./common/header.php');
include('../dbConnection.php');



$course_name = isset($_SESSION['course_name']) ? $_SESSION['course_name'] : '';

if(isset($_POST['newQuizSubmitBtn'])){
    // Checking For Empty Fields
    if(empty($_SESSION['course_name']) || empty($_POST['question']) || empty($_POST['optionA']) || empty($_POST['optionB']) || empty($_POST['optionC']) || empty($_POST['optionD']) || empty($_POST['correct_answer'])){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    } else {
        // Retrieve form data
       
        $question = $_POST['question'];
        $optionA = $_POST['optionA'];
        $optionB = $_POST['optionB'];
        $optionC = $_POST['optionC'];
        $optionD = $_POST['optionD'];
        $correct_answer = $_POST['correct_answer'];

       

        $sql = "INSERT INTO questions (course_name, question, optionA, optionB, optionC, optionD, correct_answer) 
                VALUES ('$course_name', '$question', '$optionA', '$optionB', '$optionC', '$optionD', '$correct_answer')";

        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Question Added Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add Question</div>';
        }
    }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Question</h3>
    <form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
    <label for="course_name">Course Name</label>
    <input type="text" class="form-control" name="course_name" id="course_name" value="<?php echo $course_name; ?>" readonly>
</div><br>


        <div class="form-group">
            <label for="stu_name">Question</label>
            <input type="text" class="form-control" name="question" id="question">
        </div></br>

        <div class="form-group">
            <label for="stu_email">OPTION A</label>
            <input type="text" class="form-control" name="optionA" id="optionA">
        </div></br>

        <div class="form-group">
            <label for="stu_pass">OPTION B</label>
            <input type="text" class="form-control" name="optionB" id="optionB">
        </div></br>

        <div class="form-group">
            <label for="stu_occ">OPTION C</label>
            <input type="text" class="form-control" name="optionC" id="optionC">  
        </div></br>

        <div class="form-group">
            <label for="stu_dob">OPTION D</label>
            <input type="text" class="form-control" name="optionD" id="optionD">
        </div></br>

        <div class="form-group">
            <label for="stu_gender">CORRECT ANSWER</label>
            <input type="text" class="form-control" name="correct_answer" id="correct_answer">
        </div></br>

        

        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="newQuizSubmitBtn" id="newQuizSubmitBtn">Submit</button>
            <a href="quiz.php" class="btn btn-secondary">Close</a>
        </div>

        <?php if(isset($msg)) { echo $msg; } ?>

    </form>
</div>

<?php
include('./common/footer.php');
?>
