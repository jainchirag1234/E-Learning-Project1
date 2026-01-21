<?php
include('./common/header.php');
include('../dbConnection.php');

session_start();  // Start the session

$faculty_course = isset($_SESSION['course_name']) ? $_SESSION['course_name'] : '';  // Get the faculty's course from the session

?>
<style>
    .table {
        table-layout: auto;
    }
</style>
<div class="col-sm-9 mt-5">
    <!--Table-->
    <p class="bg-dark text-white p-2 mt-5"> List of Quiz </p>
    <?php
    // Modify the SQL query to include the condition for faculty's course
    $sql = "SELECT * FROM questions WHERE course_name = '$faculty_course'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Quiz ID</th>
                    <th scope="col">COURSE NAME</th>
                    <th scope="col">Question</th>
                    <th scope="col">OPTION A</th>
                    <th scope="col">OPTION B</th>
                    <th scope="col">OPTION C</th>
                    <th scope="col">OPTION D</th>
                    <th scope="col">Correct Answer</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['quiz_id']; ?></th>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['question']; ?></td>
                        <td><?php echo $row['optionA']; ?></td>
                        <td><?php echo $row['optionB']; ?></td>
                        <td><?php echo $row['optionC']; ?></td>
                        <td><?php echo $row['optionD']; ?></td>
                        <td><?php echo $row['correct_answer']; ?></td>
                        <td>
                            <form action="editquiz.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value='<?php echo $row["quiz_id"]; ?>'>
                                <button type="submit" class="btn btn-info mr-3" name="View" value="View">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </form>
                            <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="id" value=' <?php echo $row["quiz_id"]; ?>'>
                                <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else {
        echo "0 results";
    }

    if (isset($_POST['delete'])) {
        $deleteId = $_POST['id'];
        $sql = "DELETE FROM questions WHERE quiz_id = $deleteId";
        if ($conn->query($sql) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
        } else {
            echo "Unable to delete";
        }
    }

    ?>
</div>

</div>
<!--div Row Close From Header-->

<div>
    <a href="./add_quiz.php" class="btn btn-danger box"><i class="bi bi-plus-lg"></i>  &nbsp; Add New Quiz</a>
</div>

</div>
<!--div container-fluid close from header-->

<?php
include('./common/footer.php');
?>
