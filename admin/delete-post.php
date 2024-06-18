<?php
include 'config.php';

if(isset($_GET['post_id'])){

    // myFunction($_GET);
    $post_id = $_GET['post_id'];
    $category_id = $_GET['category_id'];

    $sql = "DELETE FROM post WHERE post_id = {$post_id};";

    $sql .= "UPDATE category SET post = (post - 1) WHERE category_id = {$category_id}";

    if(mysqli_multi_query($conn,$sql)){
        header("Location: ./post.php");
    }else{
        echo "Some things went wrong";
    }
}

?>