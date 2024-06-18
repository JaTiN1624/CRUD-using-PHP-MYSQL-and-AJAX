<?php error_reporting(E_ALL); ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>COURSE DETAILS</title>
    

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

    <style>
        .nav{
            color:#fff;
            font-weight:bold;
        }
    </style>
</head>
<body>
<!-- navbar  -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand"  href="student.php">Student Management </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="student.php">Home</a>
        </li>
        <li class="nav-item nav">
          <a class="nav-link" href="courses.php">Courses</a>
        </li>
      </ul>
    
    </div>
  </div>
</nav>
<!-- navbar end -->

<!-- button for go back  -->
<div class="">
<button onclick="goBack()"  class="viewStudentBtn btn btn-primary m-3">Go Back</button>

</div>
<script>
        function goBack() {
            window.history.back();
        }
    </script>
    <!-- button for go back -->

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h3 id='show'></h3>
                  
 
              
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Student Email</th>
                                <th>Student Number</th>
                                <th>Student City</th>
                            
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            require 'conn.php';
                            $course_id = $_GET['c_id'];
                           
                            // $query = "SELECT * FROM coursedetails INNER JOIN students ON coursedetails.course_id = students.id WHERE students.id = $person_id; ";
                            // $query = "SELECT * FROM enrollment WHERE id = $person_id";
                               $query= "SELECT 
                               e.id AS enrolled_students,
                               s.id AS student_id,
                               s.name AS student_name,
                               s.email AS student_email,
                               s.phone AS student_phone,
                               s.course AS student_course
                           FROM enrollment1 e
                           INNER JOIN students1 s ON e.id = s.id
                           INNER JOIN coursedetails1 c ON e.Course_ID = c.Course_ID
                           WHERE c.Course_ID = $course_id;";
                            
                            $query_run = mysqli_query($con, $query);
                        
                            
                            if(mysqli_num_rows($query_run) > 0)
                            { 
                                
                                foreach($query_run as $student)
                                {
                                  ?>
                                    <tr>
                                        
                                        <td><?= $student['student_id'] ?></td>
                                        <td><?= $student['student_name'] ?></td>
                                        <td><?= $student['student_email'] ?></td>
                                        <td><?= $student['student_phone'] ?></td>
                                        <td><?= $student['student_course'] ?></td>
                                        <!-- <td>
                                            <button type="button" value="<?=$student['Course_ID'];?>" class="deleteStudentBtn1 btn btn-danger btn-sm">Delete</button>
                                            
                                        </td> -->
                                        
                                        
                                       
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>

      // get username and rollnumber from previous page
   function getParameterByName(name, url) {
    if (!url) {
        url = window.location.href;
    }
    name = name.replace(/[[\]]/g, '\\$&');
    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
          results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}



$(document).ready(function() { // Removed "event" from the function name
    var name = getParameterByName('name');
    var id = getParameterByName('c_id');

    document.getElementById('show').innerHTML = ''  + ' Following students are enrolled for ' + name;
});




</script>

</body> 
</html>