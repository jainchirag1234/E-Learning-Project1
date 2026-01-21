<?php
include_once('../dbConnection.php');
//Admin Login Verification
if(!isset($_SESSION['is_admin_login'])){
if(isset($_POST['checkLogemail']) && isset($_POST['adminLogEmail']) && isset($_POST['adminLogPass'])){
    $adminLogEmail = $_POST['adminLogEmail'];
    $adminLogPass = $_POST['adminLogPass'];
    $sql = "SELECT email, pass FROM student WHERE email='".$adminLogEmail."' AND pass='".$adminLogPass."'";

    $result = $conn->query($sql);
    $row= $result->num_rows;

    if($row === 1){
        $_SESSION['is_login'] = true;
        $_SESSION['adminLogEmail'] = $adminLogEmail;
        echo json_encode($row);
    } else if($row === 0 ){
        echo json_encode($row);
    } 

    }
}
?>