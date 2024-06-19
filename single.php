<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                    <?php 
                    include 'config.php';
                    if(isset($_GET['post_id'])){

                        $post_id = $_GET['post_id'] ; 
                        $sql = "SELECT post.post_id,post.title,post.description,post.category,post.post_date,post.author,post.post_img,category.category_name,user.username
                                FROM post
                                LEFT JOIN user ON post.author = user.user_id
                                LEFT JOIN category ON post.category = category.category_id WHERE post.post_id = {$post_id}";
                                $result = mysqli_query($conn,$sql) or die("Query Failed");
                                if(mysqli_num_rows($result)>0){
                                    while($row = mysqli_fetch_assoc($result)){
                    
                    ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row['title'] ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?php echo $row['category_name'] ?>
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
                            <img class="single-feature-image" src="images/post_1.jpg" alt=""/>
                            <p class="description">
                            <?php echo $row['description'] ?>
                            </p>
                        </div>
                        <?php 
                                    }
                                }
                            }
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
