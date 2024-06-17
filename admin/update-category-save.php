<?php 
include 'config.php';

if(isset($_POST['sumbit'])){
    $category_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];

    $sql = "UPDATE category SET category_name = '{$cat_name}' WHERE category_id = '{$category_id}'";
     if(mysqli_query($conn,$sql)){
        header("Location: ./category.php");
     }else{
        echo "Some things went wrong";
     }
}

?>