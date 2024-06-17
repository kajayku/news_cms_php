<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <?php 
              include 'config.php';
              if(isset($_GET['category_id'])){
                $category_id = base64_decode($_GET['category_id']) ;
                $sql = "SELECT * FROM category WHERE category_id = {$category_id}";
                $result = mysqli_query($conn,$sql) or die("Query Failed");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){

                  
              ?>
              <div class="col-md-offset-3 col-md-6">
                  <form action="update-category-save.php" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
                <?php 
                
                    }
                }
            }
                
                ?>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
