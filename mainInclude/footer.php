

      <!--Start Registration modal  -->
      


      
      <!-- Start Login model -->
      <div class="modal fade" id="studLogModalcentre" tabindex="-1" aria-labelledby="studLogModalcentreLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="studLogModalcentreLabel">Student Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- Start student Login form -->

      <form stu="stuLoginform">
    <div class="form-group">
    <i class="fas fa-envelope"></i> 
    <label for="stuLogEmail" class="pl-2 font-weight-bold">Email address</label>
    <input type="email" class="form-control" id="stuLogEmail" placeholder="Enter your email" name="stuLogEmail" >
    <small class="form-text">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <i class="fas fa-key"></i> 
    <label for="stuLogpass" class="pl-2 font-weight-bold">Password</label>
    <input type="password" class="form-control" id="stuLogpass" placeholder="Enter your password" name="stuLogpass">
  </div>
  <!-- End student Login form -->

    
      </div>
      <div class="modal-footer">
        <small id="statusLogMsg"></small>
        <button type="button" class="btn btn-primary" id="stuLoginBtn" onclick="checkStuLogin()">Login</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
  </div>

  <!-- Start Admin Login model -->
  
      <!-- Start admin Login form -->



    

    <!--Jquery and Bootstrap Javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--Font Awesome JS-->
    <script src="js/all.min.js"></script>
    <!-- Student Ajax Call javascript -->
    <script type="text/javascript" src="js/ajaxrequest.js"></script>

    <!-- Admin Ajax Call javascript -->

    

</body>
</html>