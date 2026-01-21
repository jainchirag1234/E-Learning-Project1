<?php

include('./admininclude/header.php');
include('../dbConnection.php');


?>

<div class="col-sm-4 mt-5"> <!-- Adjust the width as needed, e.g., col-sm-4 for a small box -->
<form action="" method="GET" class="mt-3 form-inline d-print-none">
    <div class="form-group">
        <label for="course_name">Course Name</label>
        <select class="form-control" name="course_name" id="course_name">
            <?php
                // Assuming $conn is your database connection
                $sql = "SELECT * FROM course";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $course_name = $row['course_name'];
                        echo "<option value=\"$course_name\">$course_name</option>";
                    }
                }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-danger" name="check_course" id="check_course" >Search</button>
</form>

    </div>
</div>

<?php
if (isset($_GET['check_course'])) {
    $input_course_name = $_GET['course_name'];  // Corrected variable name

    $sql = "SELECT * FROM course WHERE course_name = '$input_course_name'";  // Added single quotes
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['course_id'] = $row['course_id'];
        $_SESSION['course_name'] = $row['course_name'];
        ?>
        <h3 class="mt-5 bg-dark text-white p-2">Course ID: <?php echo $row['course_id']; ?>   &nbsp;    Course Name: <?php echo $row['course_name']; ?></h3>
        <?php
    } else {
        echo "<p class='mt-5 bg-dark text-white p-2'>Course not found</p>";  // Updated message
    }
}


?>
<?php 
if (isset($_SESSION['course_id'])) {
    echo '<div>
        <a href="./addLesson.php" class="btn btn-danger box"><i class="bi bi-plus-lg"></i>  &nbsp; Add New Lesson</a>
    </div>';
}
?>
<?php
if (isset($_GET['check_course'])) {
    $input_course_name = $_GET['course_name'];

    // Use prepared statement to avoid SQL injection
    $sql = "SELECT * FROM lesson WHERE course_name = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Error preparing the query: ' . $conn->error);
    }

    $stmt->bind_param('s', $input_course_name);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result === false) {
        die('Error executing the query: ' . $conn->error);
    }

    echo '<table class="table">
    <thead>
    <tr>
    <th scope="col">Lesson ID</th>
    <th scope="col">Lesson Name</th>
    <th scope="col">Lesson Link</th>
    <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<th scope="row">' . $row["lesson_id"] . '</th>';
            echo '<td>' . $row["lesson_name"] . '</td>';
            echo '<td>' . $row["lesson_link"] . '</td>';
            echo '<td><form action="editlesson.php" method="POST" class="d-inline">
            <input type="hidden" name="id" value='. $row["lesson_id"] .'>
            <button type="submit" class="btn btn-info mr-3" name="View" value="View">
                <i class="bi bi-pencil-square"></i>
            </button>
        </form>
            </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="4" class="error-message">No Lessons Found For This Course</td></tr>';  
      }


    echo '</tbody>
    </table>';

    $stmt->close();
}
?>
<?php

include('./admininclude/footer.php');
?>
