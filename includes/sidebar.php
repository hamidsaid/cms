<div class="col-md-4">



<?php

?>

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>

    <form action="searchbar.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>


<?php 
 
 $query = "SELECT * FROM categories";
 $results = mysqli_query($connection , $query);

 if(!$results){
     die("Query Failed" . mysqli_error($connection));
 }

?>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
            <?php 
            //displaying the categories in the side bar
            while($row = mysqli_fetch_assoc($results)) {
                $cat_title = $row["cat_title"];
                $cat_id = $row["cat_id"];
            //sending a url with cat id to category to php
                echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";

            }
            ?>
              
            </ul>
        </div>
     
    </div>
    <!-- /.row -->
</div>

<?php include "sidebarwidget.php"; ?> 