<?php
    include("conn.php");
    if(isset($_POST["submit"])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count == 1){
            header("Location: dashboard.php");
            exit(); // Ensure that no further code is executed after redirection
        }
        else{
            echo '<script>
                    alert("Login failed: invalid username or password!!!");
                    window.location.href = "index.php";
                  </script>';
            exit(); // Ensure that no further code is executed after redirection
        }
    }
?>
