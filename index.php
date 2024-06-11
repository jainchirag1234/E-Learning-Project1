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
     <!-- <div class="col">
      <div class="card" style="width: 18rem;">
        <img src="./images/courseimg/python.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    
        </div>

        <div class="card-footer">
          <p class="card-text d-inline">Price: <small><del>&#8377 2000</del></small> <span class="font-weight-bolder">&#8377 200</span></p> <a class="btn btn-primary text-white font-weight-bolder float-right" href="#">Enroll</a>
        </div>
      </div>

  
    </div>

 
  </div>
</div> -->
    <br/>


    
    <!--End Most Popular Courses 2nd Card Deck-->

<div class="text-center">
  <a class="btn btn-danger btn-sm btn-center" href="courses.php">View All Course</a>

</div>


  <!--End Most Popular Course-->

  <!--start contact us-->
  <?php
  
    include('./contact.php');
  ?>
  <!-- <ul class="navbar.php">
    <li class="nav-item"><a href="" class="nav-link">Contact</a></li>
  </ul> -->
  <!--End Contact Us-->
  
 <!-- Start Students Testimonals -->
   <!--<div class="container-fluid mt-5" style="background-color: #487289" id="Feedback">
        <h1 class="text-center testyheading p-4">Student's Feedback</h1>
        <div class="row">
          <div class="col-md-12">
            <div id="testimonal-slider" class="owl-carousel">
              <?php
              $sql = "SELECT  s.stu_name, s.stu_occ, s.stu_img, f.f_content FROM student AS s JOIN feedback AS f ON s.stu_id = f.stu_id";
              $result= $conn->query($sql);
              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                  $s_image = $row['$stu_image'];
                  $n_img = str_replace('..','.', $s_img);
               
              ?>

              <div class="testimonal">
                <p class="text-center description">
                  <?php echo $row['f_content']; ?>
                </p>
                <div class="pic">
                  <img src="<?php echo $n_img ?>" alt="">
                </div>
                <div class="testimonal-prof">
                  <h4> <?php echo $row['$stu_name'] ?> </h4>
                  <small><?php echo $row['$stu_occ'] ?></small>
                </div>
              </div>
           <?php }
              } ?>
            </div>
          </div>
        </div> -->

  
        <!-- End Testimonals  -->
        <div class="container-fluid bg-danger">
          <div class="row text-white text-center p-1">
            <div class="col-sm">
              <a class="text-white social-hover" href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
            </div>
            <div class="col-sm">
              <a class="text-white social-hover" href="#"><i class="fab fa-twitter"></i> Twitter</a>
            </div>
            <div class="col-sm">
              <a class="text-white social-hover" href="#"><i class="fab fa-whatsapp"></i> Whatsapp</a>
            </div>
            <div class="col-sm">
              <a class="text-white social-hover" href="#"><i class="fab fa-instagram"></i> Instagram</a>
            </div>
          </div>
        </div>

        <!-- About Section -->
        <div class="container-fluid p-4" style="background-color:#E9ECEF">
        <div class="container"style="background-color:#E9ECEF">
        <div class="row text-center">
          <div class="col-sm">
            <h5>About Us</h5>
            <p>Learn Worlds provides universal access to the world's best education,partnering with top universitities and organisations to offer courses online.</p>
          </div>
          <div class="col-sm">
            <h5>Category</h5>
            <a class="text-dark"href="#">Web Development</a><br>
            <a class="text-dark"href="#">Web Designing</a><br>
            <a class="text-dark"href="#">Android App Development</a><br>
            <a class="text-dark"href="#">iOS Development</a><br>
            <a class="text-dark"href="#">Data Analysis</a><br>

          </div>
          <div class="col-sm">
            <h5>Contact Us</h5>
            <p>Learn Worlds Pvt Ltd <br> Near Surat Airpot <br> Dumas Road, Surat <br> Ph.0000000000</p>
          </div>
        </div>
      </div>
      </div><!--End About Section-->

      <!--Start Including Footer-->
      <?php 
      include('./mainInclude/footer.php');
      ?>
      <!--End Including Footer-->