<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

     <!-- Bootstrap ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <!-- Font Awesome CSS  -->
    <link rel="stylesheet" href="../css/all.min.css">

     <!-- Google fonts -->
     <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

     <!-- Custom CSS  -->
     <link rel="stylesheet" href="../css/adminstyle.css">

     <script>
        function updateCoursePrice() {
        var originalPrice = document.getElementById("course_original_price").value;
        var discount = document.getElementById("course_discount").value;
        var discountedPrice = originalPrice - (originalPrice * (discount / 100));
        document.getElementById("course_price").value = discountedPrice.toFixed(2);
    }
     </script>


</head>
<body>
    <nav class="navbar navbar-dark fixed-top p-0 shadow" style="background-color: #225470;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">E-learning
        <small class="text-white"> Admin Panel</small></a>

    </nav>
    </br>
    <!-- Side bar -->
    <div class="container-fluid_mb-5" style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 bg-light sidebar py-5d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                            <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="courses.php">
                                <i class="bi bi-book"></i>
                                Courses
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="lessons.php">
                            <i class="bi bi-journal-bookmark-fill"></i>
                                Lessons
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="students.php">
                            <i class="bi bi-people-fill"></i>
                                Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sellReport.php">
                            <i class="bi bi-bar-chart"></i>
                                Sell report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="faculty.php">
                            <i class="bi bi-globe2"></i>
                                Faculty
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <i class="bi bi-table"></i>
                                Payment Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="feedback.php">
                            <i class="bi bi-chat-left-text"></i>
                                Feedback
                            </a>
                        </li>

                       
                        
                        <li class="nav-item">
                            <a class="nav-link" href="adminChangepass.php">
                            <i class="bi bi-key-fill"></i>
                                Change Password
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </nav>

