<?php


require 'conn.php';

if(isset($_POST['save_course']))
{

    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $credit = mysqli_real_escape_string($con, $_POST['credit']);
    $sdate = mysqli_real_escape_string($con, $_POST['sdate']);
    $edate = mysqli_real_escape_string($con, $_POST['edate']);


    if($name == NULL || $credit == NULL || $sdate == NULL || $edate == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
            
        ];
        echo json_encode($res);
        return;
    }

    //   check the course is existed or not
    $check_query = "SELECT * FROM `coursedetails1` WHERE `Course_Name` = '$name'";
    $check_result = mysqli_query($con, $check_query);
   
    if (mysqli_num_rows($check_result) > 0) {
        // Name already exists
        $res = [
            'status' => 409, // Conflict
            'message' => 'Course already exists'
        ];
        echo json_encode($res);
        return;
    }

    if(strtotime($edate) < strtotime($sdate)) {
        $res = [
            'status' => 422,
            'message' => 'End date cannot be before start date'
        ];
        echo json_encode($res);
        return;
    }

   
              // Calculating duration in days
    // $duration = (strtotime($sdate) - strtotime($edate)) / (60 * 60 * 24); 
    // if ($duration < 30) {
    //     $res = [
    //         'status' => 422,
    //         'message' => 'Course duration must be at least 30 days'
    //     ];
    //     echo json_encode($res);
    //     return;
    // }

    $query = "INSERT INTO `coursedetails1`(`Course_Name`, `Course_credit`, `Start_date`, `End_Date`) VALUES ('$name','$credit ','$sdate','$edate')";
    $query_run = mysqli_query($con, $query);
    
    if($query_run )
    {
        $res = [ 
            'status' => 200,
            'message' => 'Course Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Course Not Created'
        ];
        echo json_encode($res);
        return;
    }
}




                                   // update course details

                                      
if(isset($_POST['update_course']))
{
    $course_id = mysqli_real_escape_string($con, $_POST['course_id']);

    $Course_Name = mysqli_real_escape_string($con, $_POST['Course_Name']);
    $Course_credit = mysqli_real_escape_string($con, $_POST['Course_credit']);
    $Start_date = mysqli_real_escape_string($con, $_POST['Start_date']);
    $End_Date = mysqli_real_escape_string($con, $_POST['End_Date']);
    
    if($Course_Name == NULL || $Course_credit == NULL || $Start_date == NULL || $End_Date == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    
    //   check the course is existed or not
    $currentCourseId = mysqli_real_escape_string($con, $_POST['course_id']);
    $check_q ="SELECT * FROM `coursedetails1` WHERE `Course_Name` = '$Course_Name' AND `Course_ID` != '$currentCourseId'";
    $check_r = mysqli_query($con, $check_q);
    
   

    if (mysqli_num_rows($check_r) > 0) {
        // Name already exists
        $res = [
            'status' => 409, // Conflict
            'message' => 'Course already exists'
        ];
        echo json_encode($res);
        return;
    }
    
                        // validate start date and end date
    if(strtotime($End_Date) < strtotime($Start_date)) {
        $res = [
            'status' => 422,
            'message' => 'End date cannot be before start date'
        ];
        echo json_encode($res);
        return;
    }

                // Calculating duration in days
    // $duration = (strtotime($End_Date) - strtotime($Start_date)) / (60 * 60 * 24); 
    // if ($duration < 30) {
    //     $res = [
    //         'status' => 422,
    //         'message' => 'Course duration must be at least 30 days'
    //     ];
    //     echo json_encode($res);
    //     return;
    // }

    $query = "UPDATE coursedetails1 SET Course_Name='$Course_Name', Course_credit='$Course_credit', Start_date='$Start_date', End_Date='$End_Date' 
    WHERE Course_ID='$course_id '";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Course Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Course Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['course_id']))
{
    $course_id = mysqli_real_escape_string($con, $_GET['course_id']);

    $query = "SELECT * FROM coursedetails1 WHERE Course_ID='$course_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $course = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Course Fetch Successfully by id',
            'data' => $course
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Course Id Not Found'
        ];
        echo json_encode($res);
        return;
    
}
}


if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $query = "DELETE FROM coursedetails1 WHERE Course_ID='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Course Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Course Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}





    // delete courses from student id 
if(isset($_POST['delete_student1']))
{
    $course_id = mysqli_real_escape_string($con, $_POST['course_id']);

    $query = "DELETE FROM enrollment1 WHERE Course_ID='$course_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Deleted'
        ];
        
        echo json_encode($res);
        return;
    }
}






