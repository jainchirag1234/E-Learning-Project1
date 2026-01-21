<?php
include('./dbConnection.php');
session_start();
if (!isset($_SESSION['stu_email'])) {
    echo "<script> location.href='loginorRegister.php'</script>";
} else {

    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");
}
$stuEmail = $_SESSION['stu_email'];


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!--Boootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Font Awesome  CSS-->
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <!-- Custom fonts -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 jumbotron">
                <h3 class="mb-5">Welcome to E-Learning Payment System</h3>
                <!-- <form method="post" action="PaytmKit/pgRedirect.php"> -->

                <div class="form-group row">
                    <label for="ORDER_ID" class="col-sm-4 col-form-label">Order ID:</label>
                    <div class="col-sm-8">
                        <input id="ORDER_ID" tabindex="1" maxlength="20" size="20"
                            name="ORDER_ID" autocomplete="off"
                            value="
                       ">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="CUST_ID" class="col-sm-4 col-form-label">Student Email</label>
                    <div class="col-sm-8"></div>
                    <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php if (isset($stuEmail)) {
                                                                                                                            echo $stuEmail;
                                                                                                                        } ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="TXN_AMOUNT" class="col-sm-4 col-form-label">Amount</label>
                <div class="col-sm-8">
                    <input id="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php if (isset($_POST['id'])) {
                                                                                                    echo $_POST['id'];
                                                                                                } ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-8">
                    <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="10" type="text" name="INDUSTRY_TYPE_ID" value="Retail" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-8">
                    <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
                        size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
                </div>
            </div>
            <div class="text-center">
                <input value="CheckOut" type="submit" class="btn btn-primary" onclick="">
                <a href="./courses.php" class="btn btn-secondary">Cancel</a>
            </div>







            </form>
            <small class="form-text text muted">Note: Complete Payment </small>
        </div>
    </div>
    </div>
</body>

</html>