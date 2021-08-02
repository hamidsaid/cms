
<?php 
//when publish button is pressed
if(isset($_POST["create_post"])) {

    $post_title =$_POST["title"];
    $post_author = $_POST['author'];
    $post_category_id =$_POST['post_category'];
    $post_status = $_POST["post_status"]; 

    $post_image = $_FILES["post_image"]["name"];
    $post_image_temp = $_FILES["post_image"]["tmp_name"];

    $post_tags = $_POST["post_tags"];
    $post_content = $_POST["post_content"];
    $post_date = date("d-m-y");
    $post_comment_count = 4; 

    move_uploaded_file($post_image_temp , "../images/$post_image"); 

    $query = "INSERT INTO posts (post_category_id,post_title,post_author,
    post_date,post_image,post_content,post_tags,post_comment_count,post_status)";

    $query .= "VALUES ({$post_category_id}, '{$post_title}','{$post_author}',now(),'{$post_image}', 
    '{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}')";

    $results = mysqli_query($connection , $query);

    if(!$results){
        die("QUERY FAILED" . mysqli_error($connection));
    }


}

?>





<form action="" class="form-group" method="post" enctype="multipart/form-data">


<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" required>
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
    <input type="text" class="form-control" name="author" required>
</div>
<div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status" required>
</div>
<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="post_image" required>
</div>
<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" required>
</div>
<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post" >
</div>



</form>
