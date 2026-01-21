<!--Start Including Header-->
<?php
include('./mainInclude/header.php');
include('./dbConnection.php')
?>
<!--End Including Header-->

<script>
    var lastScrollTop = 0;

    window.addEventListener("scroll", function(){
        var st = window.pageYOffset || document.documentElement.scrollTop;

        if (st > 56 && st > lastScrollTop){
            // Scroll down and past the navbar height
            document.querySelector('.navbar').classList.remove('fixed-top');
        } else {
            // Scroll up or not past the navbar height
            document.querySelector('.navbar').classList.add('fixed-top');
        }

        lastScrollTop = st;
    });
</script>

<!-- Start video Background -->
<div class="container-fluid remove-vid-marg">
  <div class="vid-parent">
    <video playsinline autoplay muted loop>
      <source src="video/learn.mp4">
    </video>
    <div class="vid-overlay"></div>
  </div>
  <div class="vid-content">
        <?php
       

        // Check if the user is logged in
        if (isset($_SESSION['stu_name'])) {
            // If logged in, display a link to the user's profile
            echo '<h1 class="my-content"> Welcome to Learn Worlds</h1>';
            echo '<small class="my-content">Learn and Implement</small><br>';
            echo '<a href="stu_include/StudentProfile.php" class="btn btn-primary">My Profile</a>';
        } else {
            // If not logged in, display the "Get Started" button
            echo '<h1 class="my-content"> Welcome to Learn Worlds</h1>';
            echo '<small class="my-content">Learn and Implement</small><br>';
            echo '<a href="./login.php" class="btn btn-danger" > Get Started </a>';
        }
        ?>
        <!-- Button trigger modal -->
    </div>
</div>


    


<!-- End video Background -->


<!-- Start text banner -->
<div class="container-fluid bg-danger txt-banner">
  <div class="row bottom-banner">
    <div class="col-sm">
      <h5><i class="fas fa-book-open mr-3"></i>  100+ Online Courses</h5>
    </div>
    <div class="col-sm">
      <h5><i class="fas fa-users mr-3"></i>  Expert Instructors</h5>
    </div>
    <div class="col-sm">
      <h5><i class="fas fa-keyboard mr-3"></i>  Lifetime Access</h5>
    </div>
    <div class="col-sm">
      <h5><i class="fa-solid fa-indian-rupee-sign mr-3"></i>  Money Back Guarantee</h5>
    </div>
  </div>
</div>

<!-- End text banner -->

<!--Start Most Popular  Courses-->
<div class="container mt-5">
  <h1 class="text-center">Popular Courses</h1>
  
  <!--Start Most Popular Courses 1st Card Deck-->
  <div class="row row-cols-1 row-cols-md-3 g-4">
  <?php 
    $sql = "SELECT * FROM course LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $course_id = $row['course_id'];
            echo '
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="' .str_replace('..','.' , $row['course_img']) . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['course_name'] . '</h5>
                        <p class="card-text">'.$row['course_desc']. '</p>
                    </div>

                    <div class="card-footer">
                        <p class="card-text d-inline">Price: <small><del>&#8377 ' . $row['course_original_price'] . '</del></small><span class="font-weight-bolder"><strong>&#8377 ' . $row['course_price'] . ' </strong></span></p>
                        <a class="btn btn-primary text-white font-weight-bolder float-right" href="coursedetail.php?course_id='.$course_id.'">Enroll</a>
                    </div>
                </div>
            </div>';
        }
    }
?>
  </div>
   
    <!--End Most Popular Courses 1st Card Deck-->

     <!--Start Most Popular Courses 2nd Card Deck-->
<div class="container mt-5">
     <div class="row row-cols-1 row-cols-md-3 g-4">
  <?php 
    $sql = "SELECT * FROM course LIMIT 3,3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $course_id = $row['course_id'];
            echo '
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="' .str_replace('..','.' , $row['course_img']) . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['course_name'] . '</h5>
                        <p class="card-text">'.$row['course_desc']. '</p>
                    </div>

                    <div class="card-footer">
                        <p class="card-text d-inline">Price: <small><del>&#8377 ' . $row['course_original_price'] . '</del></small> <span class="font-weight-bolder"><strong>&#8377 ' . $row['course_price'] . ' </strong></span></p>
                        <a class="btn btn-primary text-white font-weight-bolder float-right" href="coursedetail.php?course_id='.$course_id.'">Enroll</a>
                    </div>
                </div>
            </div>';
        }
    }
?>
     </div>
</div>

    <br/>


    
    <!--End Most Popular Courses 2nd Card Deck-->

<div class="text-center">
  <a class="btn btn-danger btn-sm btn-center" href="courses.php">View All Course</a>

</div>