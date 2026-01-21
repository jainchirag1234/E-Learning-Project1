



<?php
include("conn.php");
session_start(); 

if(isset($_POST["register"])) {
    $faculty_name = $_POST['faculty_name'];
    $faculty_email = $_POST['faculty_email'];
    $course_name = $_POST['course_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password !== $confirm_password) {
        echo '<script>
                alert("Error: Passwords do not match!");
                window.location.href = "faculty_registration.php";
              </script>';
        exit(); // Ensure that no further code is executed after redirection
    }

    // Hash the password before storing in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO faculty (faculty_name, faculty_email, course_name, password,confirm_password) 
            VALUES ('$faculty_name', '$faculty_email', '$course_name', '$password',$confirm_password)";

    // Execute the query
    // Replace $conn with your database connection variable
    if ($conn->query($sql) === TRUE) {
        $_SESSION['faculty_name'] = $row['faculty_name'];
        $_SESSION['faculty_email'] = $row['faculty_email'];
       
        // Add other relevant session variables if needed

        session_regenerate_id(true);
        $_SESSION['is_login'] = true;
        $_SESSION['course_name'] = $course_name; 
        echo '<script>
                alert("Faculty registered successfully!");
                window.location.href = "home.php";
              </script>';
        exit(); // Ensure that no further code is executed after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Faculty Registration</h1>
    <form action="index.php" method="post">
        <label for="faculty_name">Faculty Name:</label>
        <input type="text" name="faculty_name" required><br><br>

        <label for="faculty_email">Faculty Email:</label>
        <input type="email" name="faculty_email" required><br><br>

        <label for="course_name">Course Name:</label>
        <select class="form-control custom-select" name="course_name" id="course_name">
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
            
        </select><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br><br>

        <button type="submit" name="register">Register</button><br><br> 
        <a href="./login.php">Already Have An Account</a>
    </form>
</body>
</html>
