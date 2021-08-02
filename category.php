<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                   Best FPS games
                   
                </h1>

                <?php
                
                //catching the url
                if(isset($_GET["category"])){
                    $post_category_id = $_GET["category"];

                }
                $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
                $result = mysqli_query($connection , $query);

                while($row = mysqli_fetch_assoc($result)){
                    $post_id = $row["post_id"];
                    $post_title = $row["post_title"];
                    $post_author = $row["post_author"];
                    $post_date = $row["post_date"];
                    $post_image = $row["post_image"];
                    $post_content = $row["post_content"];

            ?>   
  
                    <!-- First Blog Post -->
                    <h2>
                        <!-- sending a url to post.php with the selected post with th post_id as a paramter  -->
                        <!-- you have to catch it in post.php  -->
                        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
    
                    <hr>
                   


               <?php } ?>
                
           


            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php" ?>