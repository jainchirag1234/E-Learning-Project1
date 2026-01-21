<?php
session_start();
include('./common/header.php');
include('../dbConnection.php');

$faculty_course = isset($_SESSION['course_name']) ? $_SESSION['course_name'] : '';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM lesson WHERE course_name = '$faculty_course'";
$result = $conn->query($sql);

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($result->num_rows > 0) {
    ?>
    <div class="col-sm-9 mt-5">
        <div class="float-end">
            <label for="ADD NEW LESSONS"></label>
            <a href="./addLesson.php" class="btn btn-danger box" id="addNewLesson">
                <i class="bi bi-plus-lg"></i> &nbsp; Add New Lessons
            </a>
        </div>

        <div class="col-sm-9 mt-5">
            <p class="bg-dark text-white p-2">List of Lessons</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Lesson ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <th scope="row"><?php echo $row['lesson_id']; ?></th>
                            <td><?php echo $row['lesson_name']; ?></td>
                            <td><?php echo $row['course_name']; ?></td>
                            <td>
                                <form action="editlesson.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value='<?php echo $row["lesson_id"]; ?>'>
                                    <button type="submit" class="btn btn-info mr-3" name="View" value="View">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
} else {
    echo "0 results";
}

include('./common/footer.php');
?>
