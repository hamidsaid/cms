<?php include "../includes/db.php" ?>

<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  
</head>

<body>

    <div id="wrapper">

  <?php include"includes/nav.php" ?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            The Admin Dashboard
                            <small>Author</small>
                        </h1>

           
             <div class="col-lg-6 col-xs-12">

                <!-- form -->

                <?php

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                $cat_title = $_POST["cat_title"];

                //Now lets insert the added category to the Database
                $query = "INSERT INTO categories(cat_title) VALUE('$cat_title')";
                $results = mysqli_query($connection , $query);

                if(!$results){
                die("Inserting the added category failed" . mysqli_error($connection));
                }

                }


              ?>
                    <form action="" method="post">

                    <div class="form-group">
                    <label for="cat-title">Add a Category</label>
                    <input type="text" class="form-control" name="cat_title" required >
                    </div>
                    <div class="form-group">
                    <input class="btn btn-primary " type="submit" name="submit" value="Add Category">
                    </div>
                    </form>

                    <?php
                    //including update_categories.php
                    //only include if the user clicks the edit button
                    if(isset($_GET["edit"])){

                     $cat_id = $_GET["edit"]; 

                     include "update_categories.php";
                    }

                    ?>
                     
                  
            </div>
                        
                        <!-- table -->
                        <div class="col-xs-12 col-lg-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
    
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>

            <?php 

                ////FIND ALL CATEGORIES QUERY          
                $query = "SELECT * FROM categories";
                $results = mysqli_query($connection , $query);

                if(!$results){
                die("Query Failed" . mysqli_error($connection));
                }

            //displaying the categories in the table
            while($row = mysqli_fetch_assoc($results)) {
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];
                echo "<tr>";
                echo " <td>{$cat_id}</td>";
                echo " <td>{$cat_title}</td>";
                //create a delete and edit link which when clicked will make a new key in the array whose value is the 
                //id of the item clicked and resend the array body via the GET superglobal 
                echo " <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                echo " <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                echo "</tr>";

            }
?>


           
<?php
            
        //php code for the delete category query
        //Checking if there is a GET superglobal to catch
         if(isset($_GET["delete"])){
             $cat_id = $_GET["delete"];
             $query= "DELETE FROM categories WHERE cat_id = {$cat_id}";
             $delete_query = mysqli_query($connection , $query);
              //This refreshes the categories page for the changes to be observed
            // header("Location :  categories.php");
            echo("<script>location.href = 'categories.php?msg=$msg';</script>");
             
         }

?>

                            </tbody>
                        </table>
                        </div>
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
