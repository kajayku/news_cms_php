<?php 
include 'config.php';

if(isset($_GET['category_id'])){
    $category_id = base64_decode($_GET['category_id']);

    $sql = "DELETE FROM category WHERE category_id = {$category_id}";
    if(mysqli_query($conn,$sql)){
        header("Location: ./category.php");
    }else{
        echo "Some things went wrong";
    }
}
?>