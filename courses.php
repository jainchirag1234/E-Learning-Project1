<?php
include('./mainInclude/header.php');
include('./dbConnection.php');
?>


<!--Start Course Page Banner--> 
<div class="container-fluid bg-dark">
    <div class="row">
        <img src="./images/coursebanner.jpg" alt="courses"
        style="height: 500px; width: 100%; object-fit:cover; box-shadow:10px;"/>
    </div>
</div>
<!--End Course Page Banner--> 




<!--Start All  Courses-->
<div class="container mt-5">
  <h1 class="text-center">All Courses</h1>
  <div class="row mt-4">
    <?php
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $course_id = $row['course_id'];
        echo '
    
        <div class="col-sm-4 mb-4">
          <div class="col">
            <div class="card h-100" style="width: 18rem;">
              <img src="' .str_replace('..','.' , $row['course_img']) . '" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">' . $row['course_name'] . '</h5>
                <p class="card-text">'.$row['course_desc']. '</p>
              </div>

              <div class="card-footer">
                <p class="card-text d-inline">Price: <small><del>&#8377 ' . $row['course_original_price'] . '</del></small> <span class="font-weight-bolder">&#8377 <strong>' . $row['course_price'] . '</strong></span></p>  &nbsp;
                <a class="btn btn-primary text-white font-weight-bolder float-right" href="coursedetail.php?course_id='.$course_id.'">Enroll</a>
              </div>
            </div>
          </div>
        </div>
      ';
      }
    }
    ?>

  </div>
 
  
</div>
    <br/>




  <!--End All Course-->



<!--Start Including Footer-->
    <?php 
      include('./mainInclude/footer.php');
      ?>
<!--End Including Footer-->