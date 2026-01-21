<?php
session_start();
include("conn.php");

if (isset($_POST["login"])) {
    $faculty_name = $_POST['faculty_name'];
    $faculty_email = $_POST['faculty_email'];
    $password = $_POST['password'];
    $selected_course_name = $_POST['course_name'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM faculty WHERE faculty_name=? AND faculty_email=? AND password=? AND course_name=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $faculty_name, $faculty_email, $password, $selected_course_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Fetch the result
        $count = mysqli_num_rows($result);

        // Check if the login credentials are correct
        if ($count == 1) {
            $row = mysqli_fetch_assoc($result);
            $course_name = $row['course_name'];

            $_SESSION['faculty_name'] = $row['faculty_name'];
            $_SESSION['faculty_email'] = $row['faculty_email'];
           
            // Add other relevant session variables if needed

            session_regenerate_id(true);
            $_SESSION['is_login'] = true;

            // Set the course name in session
            $_SESSION['course_name'] = $course_name;
            echo "Course Name: " . $course_name;

            header("Location: home.php");
            exit();
        } else {
            echo "Login failed: invalid username or password!!!";
        }

        mysqli_stmt_close($stmt); // Close the statement
    } else {
        echo "Error in SQL statement preparation: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Login</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<div id="form">
    <h1>Faculty Login</h1>
    <form action="login.php" method="post">
        <label for="faculty_name">Faculty Name:</label>
        <input type="text" name="faculty_name" required><br><br>

        <label for="faculty_email">Faculty Email:</label>
        <input type="email" name="faculty_email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <!-- Replace the static dropdown with dynamic one -->
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <select class="form-control" name="course_name" id="course_name">
                <?php
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

        <button class="custom-button" name="login">Login</button><br><br>
        <a href="index.php">Create New Account</a>
    </form>
</div>
</body>
</html>
