<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP CRUD using  ajax</title>
    

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
<button onclick="goBack()" onclick="reloadPreviousPage()"  class="viewStudentBtn btn btn-primary m-3">Go Back</button>

</div>
<script>
        function goBack() {
            window.history.back();

        }
        function reloadPreviousPage() {
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
                              <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Course Credit</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            require 'conn.php';
                            $person_id = $_GET['s_id'];
                          
                  
                          
                          //  $query= "SELECT coursedetails.Course_ID, coursedetails.Course_Name, coursedetails.Course_credit, coursedetails.Start_date, coursedetails.End_Date FROM coursedetails LEFT JOIN enrollment ON coursedetails.Course_ID = enrollment.id WHERE enrollment.id=$person_id IS NULL";

                          // $query="SELECT coursedetails.Course_ID, coursedetails.Course_Name, coursedetails.Course_credit, coursedetails.Start_date, coursedetails.End_Date FROM coursedetails INNER JOIN enrollment ON coursedetails.Course_ID = enrollment.id WHERE enrollment.id=$person_id IS NULL";
                              
                          // $query ="SELECT * 
                          // FROM coursedetails
                          // INNER JOIN enrollment ON coursedetails.Course_ID = enrollment.Course_ID
                          // WHERE enrollment.id IS NULL OR enrollment.id != $person_id";

                              $query ="SELECT coursedetails1.*, enrollment1.id AS enrollment_id
                                FROM coursedetails1
                                 LEFT JOIN enrollment1 ON coursedetails1.Course_ID = enrollment1.Course_ID AND enrollment1.id = $person_id
                                 WHERE enrollment1.id IS NULL";

                               
                            
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
                                        <td><?= $student['Start_date'] ?></td>
                                        <td><?= $student['End_Date'] ?></td>
                                        <td>
                                        <!-- <div class="form-check">
                                           <input class="crs form-check-input" type="checkbox"  value="id="flexCheckDefault"> -->

                                           <div class="form-check">
                                          <input class="crs form-check-input" type="checkbox" value="<?= $student['Course_ID'] ?>"                           
                                          id="flexCheckDefault_<?= $student['Course_ID'] ?>">
                                          <label class="form-check-label" for="flexCheckDefault_<?= $student['Course_ID'] ?>">
                                               
                                          </label>
                                         </div>
                                        </td>
                                        
                                       
                                    </tr>
                                    <?php
                                    
                                }
                            }
                            ?>
<button type="button" id="add_course1"  class="viewStudentBtn btn btn-primary  m-3">Add Courses</button>

  

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

    document.getElementById('show').innerHTML = '' + name + ' is not enrolled for following courses';
});






// getting request for inserting course into student id 
// $(document).on('submit', '#add_course', function (e) {
//     e.preventDefault();

//     var formData = new FormData(); // Create new FormData object

//     // Loop through each checked checkbox and append its value to FormData
//     $('.course-checkbox:checked').each(function() {
//         formData.append('selected_courses[]', $(this).val());
//     });

//     formData.append("add_course", true);

//     $.ajax({
//         type: "POST",
//         url: "add_course.php",
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             var res = jQuery.parseJSON(response);

//             if(res.status == 422 || res.status == 409) {
//                 $('#errorMessage').removeClass('d-none');
//                 $('#errorMessage').text(res.message);
//             }
//              else if(res.status == 200){
//                 $('#errorMessage').addClass('d-none');
//                 $('#studentAddModal').modal('hide');
//                 $('#savestudent')[0].reset();

//                 alertify.set('notifier','position', 'top-right');
//                 alertify.success(res.message);

//                 $('#myTable').load(location.href + " #myTable");
//             } else if(res.status == 500) {
//                 alert(res.message);
//             }
//         }
//     });
// });



$(document).ready(function(){

  var person_id = "<?php echo $person_id; ?>";
    $(document).on('click', '#add_course1', function (e) { 
        e.preventDefault();
       
        var courses = [];
        
        $(".crs").each(function(){
            if($(this).is(":checked")){
                  courses.push($(this).val());
            }
        });
        
        courses = courses.toString();
        // console.log(courses)
        // console.log(person_id)

        
        
        if(courses.length !== 0){
           $.ajax({
            url :"add_course.php",
             method : "POST",
            data : {courses:courses , person_id:person_id},
            success : function(response){
             
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
        }else{
           alert("please select at least one course")
         }
    });
});

</script>

</body> 
</html>