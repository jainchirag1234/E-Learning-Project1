<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <!-- Add your CSS links or styles here -->
</head>

<body>

  <!-- Start Contact Us -->
  <div class="container mt-4" id="contact">
    <h2 class="text-center mb-4">Contact Us</h2>
    <!-- Contact Us Heading -->
    <div class="row">
      <!-- Start Contact Us Row -->
      <div class="col-md-8">
        <!-- Start Contact Us 1st Column -->
        <form action="" method="post">
          <input type="text" class="form-control" name="name" placeholder="Name"><br/>
          <input type="text" class="form-control" name="subject" placeholder="Subject"><br/>
          <input type="email" class="form-control" name="email" placeholder="E-mail"><br/>
          <textarea class="form-control" name="message" placeholder="How Can We Help You?" style="height:150px;"></textarea><br/>
          <input class="btn btn-primary" type="submit" value="Send" name="submit"><br><br>
        </form>
      </div>
      <!-- End Contact Us Column 1st -->

      <div class="col-md-4 stripe text-white text-center">
        <!-- Start Contact Us 2nd Column -->
        <h4>Learn Worlds</h4>
        <p>Learn Worlds,
          Near Surat Airport, Dumas Road,
          Surat - 395007<br />
          Phone: +0000000000 <br />
          www.learnworlds.com
        </p>
      </div>
      <!-- End Contact Us 2nd Column -->
    </div>
    <!-- End Contact Us Row -->
  </div>
  <!-- End Contact Us Container -->

  <!-- PHP script for form submission -->
  <?php
    if(isset($_POST['submit'])){
      $name = $_POST['name'];
      $subject = $_POST['subject'];
      $email = $_POST['email'];
      $message = $_POST['message'];

      // You can add further processing or validation here

      // For demonstration purposes, echoing the form data
      echo "Name: $name <br>";
      echo "Subject: $subject <br>";
      echo "Email: $email <br>";
      echo "Message: $message <br>";
    }
  ?>

  <!-- End Contact Us -->

  <!-- Add your JavaScript links or scripts here -->

</body>

</html>
