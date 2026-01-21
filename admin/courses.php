<?php
include('./admininclude/header.php');
include('../dbConnection.php');

// Your HTML form
?>

<div class="col-sm-9 mt-5">
    <div class="float-end">
        <label for="ADD NEW COURSE"></label>
        <a href="./addCourse.php" class="btn btn-danger box" id="addNewCourse" >
            <i class="bi bi-plus-lg"></i> &nbsp; Add New Course
        </a>
    </div>



<div class="col-sm-9 mt-5">

    <p class="bg-dark text-white p-2">List of Courses</p>
    <?php
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Course ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['course_id']; ?></th>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['course_author']; ?></td>
                        <td>
                            <form action="editcourse.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value='<?php echo $row["course_id"]; ?>'>
                                <button type="submit" class="btn btn-info mr-3" name="View" value="View">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </form>
                            <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="id" value='<?php echo $row["course_id"]; ?>'>
                                <button type="submit" class="btn btn-secondary" name="disable" value="Block User">
                                    <i class="bi bi-file-earmark-excel"></i>
                                </button>
                            </form>
                            <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="id" value='<?php echo $row["course_id"]; ?>'>
                                <button type="submit" class="btn btn-success" name="enable" value="Unblock User">
                                    <i class="bi bi-check"></i>
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

    if (isset($_POST['disable'])) {
        // Get the course_id from the form
        $course_id = $_POST['id'];
    
        // Call the blockUser function
        blockUser($course_id);
    
        echo "Course has been disabled!";
    } elseif (isset($_POST['enable'])) {
        // Get the course_id from the form
        $course_id = $_POST['id'];
    
        // Call the unblockUser function
        unblockUser($course_id);
    
        echo "Course has been enabled!";
    }
    
    function blockUser($course_id)
    {
        // You can update your database or perform other actions to block the course
        // Example: Update the 'blocked' column in the 'course' table to 1 for the specified course_id
        $sql = "UPDATE course SET blocked = 1 WHERE course_id = $course_id";
        // Execute the SQL query using your database connection
    
        // Placeholder for actual database update logic
        // For example, you might use PDO or mysqli functions to interact with your database
    }
    
    function unblockUser($course_id)
    {
        // You can update your database or perform other actions to unblock the course
        // Example: Update the 'blocked' column in the 'course' table to 0 for the specified course_id
        $sql = "UPDATE course SET blocked = 0 WHERE course_id = $course_id";
        // Execute the SQL query using your database connection
    
        // Placeholder for actual database update logic
        // For example, you might use PDO or mysqli functions to interact with your database
    }

    // ... (your existing code)
?>
</div>
</div>
</div>



<?php
    include('./admininclude/footer.php');
?>
    
