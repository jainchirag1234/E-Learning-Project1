<?php


include('./admininclude/header.php');
include('../dbConnection.php');

?>

<div class="col-sm-9 mt-5">
    <!--Table-->
    <p class="bg-dark text-white p-2 mt-5"> List of Students </p>
    <?php
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['stu_id']; ?></th>
                        <td><?php echo $row['stu_name']; ?></td>
                        <td><?php echo $row['stu_email']; ?></td>
                        <td>
                            <form action="editstudent.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value='<?php echo $row["stu_id"]; ?>'>
                                <button type="submit" class="btn btn-info mr-3" name="View" value="View">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </form>

                                <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value=' <?php echo $row["stu_id"]; ?>' >
                                    <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                        </td>
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
        $sql = "DELETE FROM student WHERE stu_id = $deleteId";
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
    <a href="./addnewstudent.php" class="btn btn-danger box"><i class="bi bi-plus-lg"></i>  &nbsp; Add New Student</a>
</div>

</div>
<!--div container-fluid close from header-->

<?php
include('./admininclude/footer.php');
?>
