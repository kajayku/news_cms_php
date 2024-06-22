<?php 
include 'config.php';
$page = basename($_SERVER['PHP_SELF']);

switch($page){
    case "single.php" :
        echo "single";
        if(isset($_GET['post_id'])){
            $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['post_id']}";
            $result_title = mysqli_query($conn,$sql_title) or die("Query Failed Title");
            if(mysqli_num_rows($result_title)>0){
                $row = mysqli_fetch_assoc($result_title);
                $page_title = $row['title'];
            }
        }
        break;
    case "category.php" :
        if(isset($_GET['category_id'])){
            $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['category_id']}";
            $result_title = mysqli_query($conn,$sql_title) or die("Query Failed Title");
            if(mysqli_num_rows($result_title)>0){
                $row = mysqli_fetch_assoc($result_title);
                $page_title = $row['category_name'];
            }
        }
        break;
    case "search.php" :
        if(isset($_GET['search'])){
                $page_title = $_GET['search'];
        }
        break;
    default :
    $page_title = "News Website";
    break;            

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <ul class='menu'>
                <?php 
                if(isset($_GET['category_id'])){
                    $cid = $_GET['category_id'];
                }else{
                    $cid = '';
                }
                $sql = "SELECT * FROM category WHERE post > 0";
                $result = mysqli_query($conn,$sql) or die("Query Failed");
                echo  "<li><a href='index.php'>Home</a></li>";
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        if($cid == $row['category_id']){
                            $active = "active";
                        }else{
                            $active = "";
                        }
               
                   echo  "<li ><a class= '{$active}' href='category.php?category_id={$row['category_id']}'> {$row['category_name']}</a></li>";
                    
                }
            }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
