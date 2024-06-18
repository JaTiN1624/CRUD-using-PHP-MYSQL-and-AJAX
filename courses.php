
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>course details</title>
    

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

<!-- Add Student -->
<div class="modal fade" id="courseAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <form id="savec">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Course Name</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Course Credit</label>
                    <input type="number" name="credit" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Start Date</label>
                    <input type="date" name="sdate" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">End Date</label>
                    <input type="date" name="edate" class="form-control" placeholder="ex: Python,Java,etc" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="" class="btn btn-primary">Save Course</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<div class="modal fade" id="courseEditModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateCourse1">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="course_id" id="course_id" >

                <div class="mb-3">
                    <label for="">Course Name</label>
                    <input type="text" name="Course_Name" id="Course_Name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Course Credit</label>
                    <input type="number" name="Course_credit" id="Course_credit" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Start Date</label>
                    <input type="date" name="Start_date" id="Start_date" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">End Date</label>
                    <input type="date" name="End_Date" id="End_Date" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Course</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- View Student Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <p id="view_email" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Phone</label>
                    <p id="view_phone" class="form-control"></p>
                </div>
                <div class=" mb-3" >
                    <label for="">Course</label>
                    <p id="view_course" class="form-control"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Course Details
                  
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#courseAddModal">
                            Add Course
                        </button>

               </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th >Course Name</th>
                                <th>Course Credit</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'conn.php';

                            $query = "SELECT * FROM coursedetails1";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            { 
                                foreach($query_run as $student)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $student['Course_ID'] ?></td>
                                        <td ><?= $student['Course_Name'] ?></td>
                                        <td><?= $student['Course_credit'] ?></td>
                                        <td><?= $student['Start_date'] ?></td>
                                        <td><?= $student['End_Date'] ?></td>  
                                        <td> <button type="button" data-cor-id="<?=$student['Course_ID'];?> " data-cor-name="<?=$student['Course_Name'];?>  " class="coursecheck btn btn-info btn-sm">Enrolled</button>
                                            <button type="button" value="<?=$student['Course_ID'];?>" class="deleteStudentBtn btn btn-danger btn-sm">Delete</button>
                                            <button type="button" value="<?=$student['Course_ID'];?>" class="editCourseBtn1 btn btn-success btn-sm">Edit</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#savec', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_course", true);

            $.ajax({
                type: "POST",
                url: "code1.php",
                data: formData,
                processData: false,
               contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 409){
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    }
                    
                    else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#courseAddModal').modal('hide');
                        $('#savec')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);


                        $('#myTable').load(location.href + " #myTable");


                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });



        

                                  
        
                   // course edit code      
 
    
$(document).on('click', '.editCourseBtn1', function ()  {
    var course_id = $(this).val()
    // alert(course_id)

    $.ajax({
        type:"GET",
        url:"code1.php?course_id=" + course_id,
       
        success: function (response){

            var res = jQuery.parseJSON(response);
                    if(res.status == 422) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#course_id').val(res.data.Course_ID);
                        $('#Course_Name').val(res.data.Course_Name);
                        $('#Course_credit').val(res.data.Course_credit);
                        $('#Start_date').val(res.data.Start_date);
                        $('#End_Date').val(res.data.End_Date);

                        $('#courseEditModal1').modal('show');
                    }
        }
    });
           
});

$(document).on('submit', '#updateCourse1', function (e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append("update_course", true);
           

            // alert (course_id);
            $.ajax({
                type: "POST",
                url: "code1.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 409){
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);
                    }
                    else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#courseEditModal1').modal('hide');
                        $('#updateCourse1')[0].reset();

                        

                        $('#myTable').load(location.href + " #myTable");
                    }
                    else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var student_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code1.php",
                    data: {
                        'delete_student': true,
                        'student_id': student_id
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

                       
    



        // check how many students enrolled for particular course 

          
$(document).on('click', '.coursecheck', function ()  {

    var c_id = $(this).attr('data-cor-id');
    var c_name = $(this).attr('data-cor-name');
         //  var s_id = "studentinfo.php?" + s_id;
    window.location.href = 'courseinfo.php?c_id=' + c_id + '&name=' + c_name;


});
  
    </script>

</body> 
</html>