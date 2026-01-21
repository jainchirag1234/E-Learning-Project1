<?php
include('./admininclude/header.php');
include('../dbConnection.php');

$sql = "SELECT * FROM course";
$result = $conn->query($sql);
$totalcourse = $result->num_rows;

$sql = "SELECT * FROM student";
$result = $conn->query($sql);
$totalstu = $result->num_rows;

// $sql = "SELECT * FROM courseorder";
// $result = $conn->query($sql);
// $totalsold = $result->num_rows;
?>


<div class="col-sm-9 mt-5">
    <div class="row mx-5 text-center">
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-danger mb-3" style="max-width : 18rem;">
                <div class="card-header">Courses</div>
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo $totalcourse;  ?>
                    </h4>
                    <a href="courses.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Students</div>
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo $totalstu;  ?>
                    </h4>
                    <a href="students.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Sold</div>
                <div class="card-body">
                    <h4 class="card-title">
                        2
                        <!-- <?php echo $totalsold;  ?>      -->
                    </h4>
                    <a href="sellReport.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-5 mt-5 text-center">
        <!--Table-->
        <p class="bg-dark text-white p-2">Course Ordered</p>
        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Course ID</th>
                                <th scope="col">Student Email</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">22</th>
                                <td>100</td>
                                <td>user@gmail.com</td>
                                <td>20/02/2024</td>
                                <td>2000</td>
                                <td>
        <!-- <?php
        $sql = "SELECT * FROM courseorder";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Course ID</th>
                    <th scope="col">Student Email</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<th scope="row">' . $row["order_id"] . '</th>';
                echo '<td>' . $row["course_id"] . '</td>';
                echo '<td>' . $row["stu_email"] . '</td>';
                echo '<td>' . $row["order_date"] . '</td>';
                echo '<td>' . $row["amount"] . '</td>';
                echo '<td>
                <form action="" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="' . $row["co_id"] . '">
                    <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                        <i class="bi bi-trash-alt"></i>
                    </button>
                </form>
              </td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo "0 results";
        }
        ?> -->

        <button type="submit" class="btn btn-secondary" name="delete" value="delete"><i class="bi bi-trash-fill"></i></button></td>
        </tr>
        </tbody>
        </table>
    </div>
</div>
</div>
</div>

</div>


<?php
include('./admininclude/footer.php');
?>