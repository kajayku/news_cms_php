<?php 
include 'config.php';

if(isset($_POST['submit'])){

    $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
    $fname = mysqli_real_escape_string($conn,$_POST['f_name']);
    $lname = mysqli_real_escape_string($conn,$_POST['l_name']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);

    $sql = "UPDATE user SET first_name = '{$fname}',last_name = '{$lname}',username = '{$username}', role = '{$role}' WHERE user_id = '{$user_id}'";

    $result = mysqli_query($conn,$sql) or die("Query Failed");

    if($result){
        header("Location: ./users.php");
    }else{
        echo "Some things went wrong";
    }
   
}


?>