<?php 
include 'config.php';

if(isset($_POST['submit'])){
session_start();

// myFunction($_FILES['fileToUpload']);

    $post_title = mysqli_real_escape_string($conn,$_POST['post_title']);
    $postdesc = mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $date = date("d M, Y");
    $author = $_SESSION['user_id'];

    if($_FILES['fileToUpload']){

        $errors = [];

        $file_name = $_FILES['fileToUpload']['name'];
        $file_temp = $_FILES['fileToUpload']['tmp_name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_type = $_FILES['fileToUpload']['type'];
        $file_ext =  strtolower(end(explode('.',$file_name)));

        $extention = array("jpg","jpeg","png");
        if(in_array($file_ext,$extention) === false){
            $errors[] = "This type of extention is not allowed";
        }
        if($file_size > 2097152){
           $errors[] = "File size must be 2 MB or lower size";
        }

        if(empty($errors) == true){
            $file_name = time(). "_" . $file_name;
            move_uploaded_file($file_temp,"upload/".$file_name);
        }else{
            print_r($errors);
        }
    }

     $sql = "INSERT INTO post (title,description,category,post_date,author,post_img) VALUES('{$post_title}','{$postdesc}','{$category}','{$date}','{$author}','{$file_name}');";
     $sql .= "UPDATE category SET post = (post + 1) WHERE category_id = {$category}";

     if(mysqli_multi_query($conn,$sql)){
        header('Location: ./post.php');
     }else{
        echo "Some things went wrong.";
     }

}

?>