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
                                <!-- <th>Student ID</th>
                                <th>Student Name</th> -->
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Course Credit</th>
                            
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            require 'conn.php';
                            $person_id = $_GET['s_id'];
                            $person_name = $_GET['name'];
                  
                            // $query = "SELECT * FROM coursedetails INNER JOIN students ON coursedetails.course_id = students.id WHERE students.id = $person_id; ";
                            // $query = "SELECT * FROM enrollment WHERE id = $person_id";
                               $query= "SELECT students1.id, students1.name, students1.email, students1.phone, coursedetails1.Course_Name, coursedetails1.Course_ID, coursedetails1.Course_credit FROM students1 INNER JOIN enrollment1 ON students1.id = enrollment1.id INNER JOIN coursedetails1 ON enrollment1.Course_ID = coursedetails1.Course_ID WHERE enrollment1.id = $person_id or enrollment1.id is null";
                            
                            $query_run = mysqli_query($con, $query);
                        
                            
                            if(mysqli_num_rows($query_run) > 0)
                            { 
                                
                                foreach($query_run as $student)
                                {
                                  ?>
                                    <tr>
                                        
                                        <td><?= $student['Course_ID'] ?></td>
                                        <td><?= $student['Course_Name'] ?></td>
                                        <td><?= $student['Course_credit'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$student['Course_ID'];?>" class="deleteStudentBtn1 btn btn-danger btn-sm">Delete</button>
                                            
                                        </td>
                                        
                                        
                                       
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
    <button type="button" id="cbtn" data-stu-id="<?=$person_id;?>" data-stu-name="<?=$person_name;?>"class="viewStudentBtn btn btn-primary  m-3">Add Courses</button>
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
    var id = getParameterByName('s_id');

    document.getElementById('show').innerHTML = '' + name + ' is enrolled for following courses';
});



                    // deleting the course from student side
$(document).on('click', '.deleteStudentBtn1', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var course_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code1.php",
                    data: {
                        'delete_student1': true,
                        'course_id': course_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500){

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });
 

                  //   pass value to studentinfo.php
        $(document).on('click', '#cbtn', function () {
            var s_id = $(this).attr('data-stu-id'); // or $(this).data('id') if you have a data-id attribute
         var s_name = $(this).attr('data-stu-name');
        //   var s_id = "student_course.php?" + s_id;
        window.location.href = 'student_course.php?s_id=' + s_id + '&name=' + s_name;
    
         
});
</script>

</body> 
</html>