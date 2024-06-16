<?php 
include 'config.php';

$user_id = base64_decode($_GET['user_id']);

$sql = "DELETE FROM user WHERE user_id = {$user_id}";

if(mysqli_query($conn,$sql)){
    header("Location: ./users.php");
}else{
    echo "Some things went wrong!";
}
?>