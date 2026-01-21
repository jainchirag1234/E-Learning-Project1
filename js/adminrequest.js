//Ajax Call 
function checkAdminLogin() {
    var adminLogEmail = $("#adminLogEmail").val();
    var adminLogPass = $("#adminLogpass").val(); // Corrected the typo in variable name
  
    $.ajax({
      url: "../Admin/admin.php", // Corrected the URL to match the server-side file
      method: "POST",
      data: {
        checkLogemail: "checklogmail",
        adminLogEmail: adminLogEmail,
        adminLogPass: adminLogPass,
      },
      success: function (data) {
        if (data == 0) {
          $("#statusAdminLogMsg").html(
            '<small class="alert alert-danger">Invalid Email ID or Password!</small>'
          );
        } else if (data == 1) {
          $("#statusAdminLogMsg").html(
            '<small class="alert alert-success">Success Loading!..</small>'
            
          );
          setTimeout(() => {
            window.location.href = "admin/adminDashboard.php";
          }, 1000);
        }
      },
    });
}

 