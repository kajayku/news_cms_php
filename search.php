<?php include 'header.php'; 
 include 'config.php';
 $search = mysqli_real_escape_string($conn,$_GET['search']);
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">Search : <?php echo $search  ?></h2>
                  <?php 

                  if(isset($_GET['submit'])){
                    $search = mysqli_real_escape_string($conn,$_GET['search']);
                  }

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                    $limit = 5;

                    $offset = ($page-1)*$limit;

                        $sql = "SELECT post.post_id,post.title,post.description,post.category,post.post_date,post.author,post.post_img,category.category_name,user.username
                        FROM post
                        LEFT JOIN user ON post.author = user.user_id
                        LEFT JOIN category ON post.category = category.category_id WHERE post.title LIKE '%$search%' OR post.description LIKE '%$search%' ORDER BY post.post_id DESC LIMIT $offset,$limit";
                   

                    $result = mysqli_query($conn,$sql) or die("Query Failed");
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                    ?>

                    <div class="post-content">
                           <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?post_id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?post_id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'><?php echo $row['category_name'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php'><?php echo $row['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,200) ?> ...
                                        </p>
                                        <a class='read-more pull-right' href='single.php?post_id=<?php echo $row['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                 
                    <?php 
                        }
                    }

                      $sql1 = "SELECT * FROM post WHERE post.title LIKE '%$search%' OR post.description LIKE '%$search%'";
                      $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
                     if(mysqli_num_rows($result1)>0){
                        $total_record = mysqli_num_rows($result1);
                        
                        $total_pages = ceil($total_record /$limit);
                        echo '<ul class="pagination">';
                        if($page > 1){
                            echo '<li><a href = "index.php?page='.($page-1).'">Prev</a></li>';
                        }
                        for($i = 1; $i<= $total_pages; $i++){
                            if($page == $i){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                            echo '<li class = "'.$active.'"><a href = "index.php?page='.$i.'">'.$i.'</a></li>';
                        }
                        if($total_pages > $page)
                        echo '<li><a href = "index.php?page='.($page+1).'">Next</a></li>';
                        echo '</ul>';
                     }
                        ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
