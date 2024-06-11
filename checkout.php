<?php
session_start();
include('./dbConnection.php');
$cid =  $_SESSION['course_id'];

if(!isset($_SESSION['stu_id'])) {
    header('Location:./login.php');
}
$stu_id = $_SESSION['stu_id'];
$stu_email = $_SESSION['stu_email'];
$sql = "SELECT * FROM student WHERE stu_email = '$stu_email'";
$result = $conn->query($sql);
if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $stu_id = $row['stu_id'];
    $stu_name = $row['stu_name'];
}

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

if (isset($_REQUEST['payment'])) {
    $order_id = $_REQUEST['order_id'];
    $name = $_REQUEST['stu_name'];
    $email = $_REQUEST['stu_email'];
    $amount = $_REQUEST['price'];
    $course_id = $cid;
    $date = $_REQUEST['date'];
    $course_name = $_REQUEST['course_name'];

    // Randomly select a faculty member associated with the course
    $faculty_sql = "SELECT faculty_id FROM faculty WHERE course_id = '$course_id'";
    $faculty_result = $conn->query($faculty_sql);
    if ($faculty_result->num_rows > 0) {
        $faculty_row = $faculty_result->fetch_all(MYSQLI_ASSOC);
        $random_faculty_id = $faculty_row[array_rand($faculty_row)]['faculty_id'];
    } else {
        // Handle error when no faculty associated with the course
        // You can add your error handling code here
    }

    $sql = "INSERT INTO courseorder (order_id, stu_id, stu_name, stu_email, course_id, course_name, amount, order_date, faculty_id) 
        VALUES ('$order_id', '$stu_id', '$name', '$email', '$course_id', '$course_name', '$amount', '$date', '$random_faculty_id')";


    if ($conn->query($sql) === TRUE) {
        $msg = '<div class="success">Payment Successful</div>';
        $dontrefresh = '<div class="alert">Do Not Refresh Web Page</div>';
        echo "<script>setTimeout(()=>{window.location.href='stu_include/MyCourse.php';},1500);</script>";
    } else {
        $msg = '<div class="alert">Payment Failed</div>';
        echo $conn->error;
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn Worlds Checkout</title>

    <link rel="stylesheet" href="CheckoutStyle.css">

     <!-- Bootstrap CSS  -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Bootstrap ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <!-- Font Awesome CSS  -->
    <link rel="stylesheet" href="./css/all.min.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    border: none;
    text-transform: capitalize;
    transition: all .2s linear;
    background-color: #f5f5f5;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 25px;
    min-height: 100vh;
}

.container form {
    padding: 20px;
    width: 700px;
    background: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.container form .row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.container form .col {
    flex: 1 1 250px;
}

.container form .row .col .title {
    font-size: 20px;
    color: #333;
    padding-bottom: 5px;
    text-transform: uppercase;
}

.container form .row .col .inputBox {
    margin: 15px 0;
}

.container form .row .col .inputBox span {
    margin-bottom: 10px;
    display: block;
    color: #333;
}

.container form .row .col .inputBox input {
    width: 100%;
    border: 1px solid #ccc;
    padding: 10px 15px;
    font-size: 15px;
    text-transform: none;
}

.container form .row .col .inputBox input:focus {
    border: 1px solid #007bff;
}

.container form .row .col .flex {
    display: flex;
    gap: 15px;
}

.container form .row .col .flex .inputBox {
    margin-top: 5px;
}

.container form .row .col .inputBox img {
    height: 34px;
    margin-top: 5px;
    filter: drop-shadow(0 0 1px #000);
}

.container form .submit-btn {
    width: 100%;
    padding: 12px;
    font-size: 17px;
    background: #007bff;
    color: #fff;
    margin-top: 5px;
    cursor: pointer;
    font-weight: 700;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s ease-in-out;
}

.container form .submit-btn:hover {
    background: #0056b3;
}

::-webkit-scrollbar {
    display: none;
}

.alert {
    color: #fff;
    background-color: red;
    font-weight: 700;
    text-align: center;
    padding: 5px;
}

.success {
    color: #fff;
    background-color: green;
    font-weight: 700;
    text-align: center;
    padding: 5px;
}

    </style>

</head>
<body onkeydown="return (event.keyCode != 116)">
    <div class="container">
        <?php
        if (isset($_SESSION['course_id'])){
            $sql = "SELECT * FROM course WHERE course_id = '$cid'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }
        ?>
        <form action="" method="POST">
            <?php
                if(isset($msg)) {
                    echo $dontrefresh;
                    echo "<br>";
                    echo $msg;

                }
            ?><br>
            <div class="row">
                <div class="col">
                    <br>
                    <h3 class="title">Payment Details</h3>

                    <div class="inputBox">
                        <span><strong>Order ID : </strong> </span>
                        <input type="text" name="order_id" id="order_id" value="<?php echo uniqid(); ?>" readonly >
                    </div><br>

                    
                    <div class="inputBox">
                        <span><strong>Name : </strong></span>
                        <input type="text" name="stu_name" id="stu_name"  value="<?php if(isset($stu_name)) { echo $stu_name;} ?>" readonly >
                    </div><br>

                    <div class="inputBox">
                        <span><strong>Email : </strong></span>
                        <input type="text" name="stu_email" id="stu_email" value="<?php if(isset($stu_email)) { echo $stu_email;} ?>" readonly >
                    </div><br>

                    <div class="inputBox">
                        <span><strong>Course Name : </strong></span>
                        <input type="text" name="course_name" id="course_name" value="<?php echo $row['course_name'] ?>" readonly >
                    </div><br>

                    <div class="inputBox">
                        <span><strong>Amount : </strong></span>
                        <input type="text" name="price" id="price" value="&#8377;<?php echo $row['course_price'] ?>" readonly >
                    </div><br>

                    <input type="hidden" name="price" id="price" value="<?php echo $row['course_price'] ?>" readonly>


                    <div class="inputBox">
                        <input type="hidden" name="date" id="date" value="<?php echo $date; ?>" readonly >
                    </div><br>
                </div>
            </div>

            <?php

            if(!$row['course_price'] == 0){
                echo '
                <div class = "col">
                    <h3 class="title">Payment</h3>
                    <div class="inputBox">
                        <span><strong>Cards Accepted </strong></span>
                        <div style="display: flex; align-items: center;">
                            <img src="./images/payment img/cards.png" alt="cards" style="width: 150px; height: auto;">

                            <div style="margin-left: 15px;">
                                <span><strong>Card Number: </strong></span>
                                <input type="text" name="c_number" id="c_number" pattern="[0-9]{16}" title="Please enter a valid 16-digit card number" maxlength="16" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                            </div>
                        </div>
                    </div><br>
                

                    <div class="inputBox">
                        <span><strong>Expiration Date: </strong></span>
                        <div class="inputBox" style="display: inline-block; margin-right: 10px;">
                            <input type="text" name="exp_month" id="exp_month" pattern="[0-9]{2}" title="Please enter a valid two-digit month (MM)" maxlength="2" placeholder="MM" required>
                        </div>
                        <div class="inputBox" style="display: inline-block;">
                            <input type="text" name="exp_year" id="exp_year" pattern="[0-9]{4}" title="Please enter a valid four-digit year (YYYY)" maxlength="4" placeholder="YYYY" required>
                        </div>
                    </div><br>

                    
                    <div class="inputBox">
                        <span><strong>CVV: </strong></span>
                        <input type="text" name="cvv" id="cvv" pattern="[0-9]{3}" title="Please enter a valid 3-digit CVV" maxlength="3" placeholder="xxx" required>
                    </div><br>
                </div>';
            }
            
            ?>

            <button type="submit" name="payment" class="submit-btn" >Proceed </button>
           
        </form>
    </div>

    
</body>
</html>