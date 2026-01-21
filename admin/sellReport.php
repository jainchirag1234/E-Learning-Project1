<?php
include('./admininclude/header.php');
include('../dbConnection.php');
?>

<div class="col-sm-9 mt-5">
    <form action="" method="" class="d-print-none">
        <div class="form-row">
            <div class="form-group col-md-2">
                <input type="date" class="form-control" id="startdate" name="startdate">
            </div>
            <span>to</span>
            <div class="form-group col-md-2">
                <input type="date" class="form-control" id="enddate" name="enddate">
            </div>
            <div class="form-group">
                <input type="button" value="Search" class="btn btn-secondary" name="searchsubmit">
            </div>
        </div>
    </form>
</div>

<?php
if (isset($_REQUEST["searchsubmit"])) {
    $startdate = $_REQUEST['startdate'];
    $enddate = $_REQUEST['enddate'];
    $sql = "SELECT * FROM courseorder WHERE order_date BETWEEN '$startdate' AND '$enddate'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '
        <p class="bg-dark text white p-2 mt-4">Details</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Course ID</th>
                    <th scope="col">Student Email</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <th scope="row">' . $row["order_id"] . '</th>
                    <td>' . $row["course_id"] . '</td>
                    <td>' . $row["stu_email"] . '</td>
                    <td>' . $row["status"] . '</td>
                    <td>' . $row["order_date"] . '</td>
                    <td>' . $row["amount"] . '</td>
                </tr>';
        }

        echo '</tbody>
            <tr>
                <td>
                
                    <form class="d-print-none">
                    <br>
                        <input class="btn btn-danger" type="submit" value="Print" onClick="window.print()">
                    </form>
                </td>
            </tr>
        </table>';
    } else {
        echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'>No records found!</div>";
    }
}
?>

<?php
include('./admininclude/footer.php');
?>
