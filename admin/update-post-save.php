<?php 
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $post_id = $_POST['post_id'];

    if($_POST['old_image']){
        $file_name = $_POST['old_image'];
    }
    if($_FILES['new_image']){
        $file_name = $_FILES['new_image']['name'];
        $file_temp = $_FILES['new_image']['tmp_name'];
        $file_type = $_FILES['new_image']['type'];
        $file_size = $_FILES['new_image']['size'];
        $file_ext = explode('.',$file_name);
        $file_ext = strtolower(end($file_ext));  

        $errors = array();
        $extentions = ['jpg','jpeg','png'];

        if(in_array($file_ext,$extentions) === false){
            $errors[] = "Please enter validate formate of image like jpg,jpeg,png";
        }

        if($file_size > 2097152){
            $errors[] = "Image must be 2MB or lower size";
        }

        if(empty($errors) === true){
           move_uploaded_file($file_temp,"upload/".$file_name);
        }else{
            print_r($errors);
        }

    }

    $post_title = mysqli_real_escape_string($conn,$_POST['post_title']);
    $postdesc = mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    //$date = date("d M, Y");
    $author = $_SESSION['user_id'];

    $sql = "UPDATE post SET title= '{$post_title}', description = '{$postdesc}', category = '{$category}' , author = '{$author}' WHERE post_id = {$post_id} ";

    $result = mysqli_query($conn,$sql) or die("Query Failed");
    if($result){
        header("Location: ./post.php");
    }else{
        echo "Some things went wrong !";
    }
}

?>