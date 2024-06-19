<?php
include 'config.php';

if(isset($_GET['post_id'])){

    $post_id = $_GET['post_id'];
    $category_id = $_GET['category_id'];

    $sql1 = "SELECT post_img FROM post WHERE post_id = {$post_id}";
    $result = mysqli_query($conn,$sql1) or die("Query Failed");
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $post_img = $row['post_img'];
            // myFunction($post_img);
            unlink("upload/".$post_img);
        }
    }

    $sql = "DELETE FROM post WHERE post_id = {$post_id};";

    $sql .= "UPDATE category SET post = (post - 1) WHERE category_id = {$category_id}";

    if(mysqli_multi_query($conn,$sql)){
        header("Location: ./post.php");
    }else{
        echo "Some things went wrong";
    }
}

?>