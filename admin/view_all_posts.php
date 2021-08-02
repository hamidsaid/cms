

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $query = "SELECT * FROM posts";
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
                                    $post_comment_count = $row["post_comment_count"];
                                    $post_date = $row["post_date"];

                                    echo"<tr>";
                                    echo"<td> {$post_id} </td>";
                                    echo"<td> {$post_author} </td>";
                                    echo"<td> {$post_title} </td>";

                               // relate posts Db with categories Db to fetch a category
                               
                                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                                $cat_result = mysqli_query($connection ,$query);
                                while($row = mysqli_fetch_assoc($cat_result)){
                                    $cat_title = $row["cat_title"];

                                    echo"<td> {$cat_title} </td>";
                                }

                                   // echo"<td> {$post_category_id} </td>";
                                    echo"<td> {$post_status} </td>";
                                    echo"<td><img width='100' src='../images/$post_image' alt ='$post_image'></td>";
                                    echo"<td> {$post_tags} </td>";
                                    echo"<td> {$post_comment_count} </td>";
                                    echo"<td> {$post_date} </td>"; 
                                    //sending source as a key to posts.php for routing & specific post_
                                    //id to edit_post.php as url parameters
                                    echo"<td><a href='posts.php?source=edit_post&selected_P_id={$post_id}'>Edit</a></td>";
                                    echo"<td><a href='posts.php?delete= {$post_id}'>Delete</a></td>";                         
                                    echo"</tr>";
                                }

                       
                                ?>

                            </tbody>
                        </table>

                        <?php
                        if(isset($_GET['delete'])){

                            $selected_post_id = $_GET['delete'];

                            $delete_query = "DELETE FROM posts WHERE post_id = {$selected_post_id}";

                            $results = mysqli_query($connection , $delete_query);

                            if(!$results){
                                die("QUERY FAILED" . mysqli_error($connection));
                            }

                        //This refreshes the categories page for the changes to be observed
                        // header("Location :  categories.php");
                        echo("<script>location.href = 'posts.php?msg=$msg';</script>");

                        }

                        ?>

