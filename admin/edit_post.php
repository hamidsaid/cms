<?php

//check if post id is sent to this page via the url

if (isset($_GET['selected_P_id'])) {

    $selected_post_id = $_GET["selected_P_id"];

    $query = "SELECT * FROM posts WHERE post_id = $selected_post_id";
    $results = mysqli_query($connection, $query);
    if (!$results) {
        die("Query failed" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($results)) {

        $post_id = $row["post_id"];
        $post_title = $row["post_title"];
        $post_author = $row["post_author"];
        $post_category_id = $row["post_category_id"];
        $post_status = $row["post_status"];
        $post_image = $row["post_image"];
        $post_tags = $row["post_tags"];
        $post_content = $row["post_content"];
        $post_comment_count = $row["post_comment_count"];
        $post_date = $row["post_date"];
    }

  
}

?>


<form action="" class="form-group" method="post" enctype="multipart/form-data" name="form_update">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo "{$post_title}"; ?>" class="form-control" name="title" required>
    </div>
    <div class="form-group">
        <label for="">Post Category</label>
        <br>

        <select name="post_category" id="">

            <?php
            //display categories rom db for user to edit
            $query = "SELECT * FROM categories";
            $results = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($results)) {
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }

            ?>

        </select>

    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" value="<?php echo "{$post_author}"; ?>" class="form-control" name="author" required>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" value="<?php echo "{$post_status}"; ?>" class="form-control" name="post_status" required>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label> <br>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <br><br>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo "{$post_tags}";  ?>" class="form-control" name="post_tags" required>
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo "{$post_content}"; ?>
    </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>



</form>
<?php

//sending the updated data to the Db
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $post_title = $_POST["title"];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST["post_status"];

        $post_image = $_FILES["post_image"]["name"];
        $post_image_temp = $_FILES["post_image"]["tmp_name"];

        $post_tags = $_POST["post_tags"];
        $post_content = $_POST["post_content"];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        //before updating
        //check if image is not changed make sure itis not empty if empty fetch from Db
        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $selected_post_id";
            $results = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($results)) {
                $post_image = $row["post_image"];
            }
        }

        $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_date = now() ";
        $query .= ", post_author='{$post_author}' , post_status='{$post_status}', post_tags='{$post_tags}', post_content='{$post_content}', ";
        $query .= "post_image='{$post_image}' WHERE post_id = {$selected_post_id}";

        $update_results = mysqli_query($connection, $query);
        if (!$update_results) {
            die(" UPDATE QUERY FAILED" . mysqli_error($connection));
        }
    }

    ?>