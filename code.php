<?php


require 'conn.php';

if(isset($_POST['save_student']))
{
   
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    if($name == NULL || $email == NULL || $phone == NULL || $course == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
            
        ];
        echo json_encode($res);
        return;
   
    }

     // Validate  name (no numbers)
     if(preg_match('/\d/', $name)) {
        $res = [
            'status' => 422,
            'message' => ' Name cannot contain numbers'
        ];
        echo json_encode($res);
        return;
    }

    //  Validate email id
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $res = [
            'status' => 422,
            'message' => 'Invalid email format'
        ];
        echo json_encode($res);
        return;
    }

     // Validate phone number format
     if(!preg_match("/^[0-9]{10}$/", $phone)) {
        $res = [
            'status' => 422,
            'message' => 'Invalid phone number format! Please Enter 10 digit number'
        ];
        echo json_encode($res);
        return;
    }

    // Validate city name (no numbers)
    if(preg_match('/\d/', $course)) {
        $res = [
            'status' => 422,
            'message' => 'City name cannot contain numbers'
        ];
        echo json_encode($res);
        return;
    }


    $query = "INSERT INTO students1 (name,email,phone,course) VALUES ('$name','$email','$phone','$course')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [ 
            'status' => 200,
            'message' => 'Student Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

                    //    update student details 
if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    if($name == NULL || $email == NULL || $phone == NULL || $course == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    // Validate  name (no numbers)
    if(preg_match('/\d/', $name)) {
        $res = [
            'status' => 422,
            'message' => ' Name cannot contain numbers'
        ];
        echo json_encode($res);
        return;
    }

    //  Validate email id
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $res = [
            'status' => 422,
            'message' => 'Invalid email format'
        ];
        echo json_encode($res);
        return;
    }

     // Validate phone number format
     if(!preg_match("/^[0-9]{10}$/", $phone)) {
        $res = [
            'status' => 422,
            'message' => 'Invalid phone number format! Please Enter 10 digit number'
        ];
        echo json_encode($res);
        return;
    }

    // Validate city name (no numbers)
    if(preg_match('/\d/', $course)) {
        $res = [
            'status' => 422,
            'message' => 'City name cannot contain numbers'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE students1 SET name='$name', email='$email', phone='$phone', course='$course' 
                WHERE id='$student_id'";

    if(mysqli_query($con, $query))
    {
        $res = [
            'status' => 200,
            'message' => 'Student Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Updated'
        ];
        echo json_encode($res);
        return;
    }
   
}

if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT * FROM students1 WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Student Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Student Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

// if(isset($_GET['student_id']))
// {
//     $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

//     $query = "SELECT * FROM students1 WHERE id='$student_id'";
//     $query_run = mysqli_query($con, $query);

//     if(mysqli_num_rows($query_run) == 1)
//     {
//         $student = mysqli_fetch_array($query_run);

//         $res = [
//             'status' => 200,
//             'message' => 'Student Fetch Successfully by id',
//             'data' => $student
//         ];
//         echo json_encode($res);
//         return;
//     }
//     else
//     {
//         $res = [
//             'status' => 404,
//             'message' => 'Student Id Not Found'
//         ];
//         echo json_encode($res);
//         return;
//     }
// }

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $query = "DELETE FROM students1 WHERE id='$student_id'";
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