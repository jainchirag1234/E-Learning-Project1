<?php
session_start(); // Start session if not already started

include('./admininclude/header.php');
include('../dbConnection.php');

?>

<div class="col-sm-9 mt-5">
    <!--Table -->
    <p class="bg-dark text-white p-2">List of feedback</p>

    <?php
    $sql = "SELECT * FROM feedback";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Feedback ID</th>
                    <th scope="col">Content</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <th scope="row">' . $row["f_id"] . '</th>
                    <td>' . $row["f_content"] . '</td>
                    <td>' . $row["stu_id"] . '</td>
                    <td>
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="' . $row["f_id"] . '">
                            <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                                <i class="bi bi-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo "0 results";
    }

    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM feedback WHERE f_id = {$_POST['id']}";

        if ($conn->query($sql) === TRUE) {
            echo '<meta http-equiv="refresh" content="0; URL=?deleted"/>';
        } else {
            echo "Unable to delete data";
        }
    }

    include('./admininclude/footer.php');
?>
