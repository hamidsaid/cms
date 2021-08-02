   <form action="" method="post">
     <div class="form-group">
       <label for="cat-title">Edit Category</label>

       <?php
        //Editing a category title
        //This runs when user clicks the edit button

        $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $results = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($results)) {
          $cat_id = $row["cat_id"];
          $cat_title = $row["cat_title"];

        ?>

         <input type="text" class="form-control" name="cat_title" value=" <?php
        //Outputing the selected value on the input field for editing
            if (isset($cat_title)) {
             echo $cat_title;
         } ?>
        " required>

       <?php  }  ?>


       <?php
        //Making a query to update data in the Db
        if (isset($_POST["update_category"])) {

          $new_cat_title = $_POST["cat_title"];
          $query = "UPDATE categories  SET cat_title = '{$new_cat_title}' WHERE cat_id = {$cat_id} ";
          $update_query = mysqli_query($connection, $query);

          if (!$update_query) {
            die("UPDATE QUERY FAILED" . mysqli_error($connection));
          }
        }

        ?>


     </div>
     <div class="form-group">
       <input class="btn btn-primary " type="submit" name="update_category" value="Update Category">
     </div>
   </form>