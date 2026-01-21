<?php
if (
    isset($_POST['checkLogemail']) &&
    isset($_POST['stuLogEmail']) &&
    isset($_POST['stuLogPass'])
) {
    require_once("lmp_db.php"); // Include your database connection file

    $stuLogEmail = $_POST['stuLogEmail'];
    $stuLogPass = $_POST['stuLogPass'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT stu_email, stu_pass FROM student WHERE stu_email = stuLogEmail AND stu_pass = stuLogPass");
    $stmt->bind_param("ss", $stuLogEmail, $stuLogPass);
    $stmt->execute();
    $stmt->store_result();

    $row = $stmt->num_rows;

    if ($row === 1) {
        echo json_encode($row);
    } else if ($row === 0) {
        echo json_encode($row);
    }

    $stmt->close();
    $conn->close();
}
?>
