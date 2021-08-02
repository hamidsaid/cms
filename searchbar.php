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

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $search = $_POST["search"];

            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
            $search_results = mysqli_query($connection , $query);

            if(!$search_results){
                die("QUERY FAILED " . mysqli_error($connection));
            }

            //lets check if the results chosen by the tags from the Db
            // were found and returned
            $count = mysqli_num_rows($search_results);
            if($count == 0){

            die("<h1> No search results</h1>") ;

        } else{

            while($row = mysqli_fetch_assoc($search_results)){

                $post_title = $row["post_title"];
                            $post_author = $row["post_author"];
                            $post_date = $row["post_date"];
                            $post_image = $row["post_image"];
                            $post_content = $row["post_content"];
                    
                    }
                    
                }

             

            ?>
  
                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
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
