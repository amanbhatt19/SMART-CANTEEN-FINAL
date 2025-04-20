<?php
include "connection.php" ;
include "header.php";
?>
<!--content area-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Display Added Foods</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
       
            <div class="row">
            <div class="col-lg-12">
                    <div class="card">
                       
                        <div class="card-body">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">food image</th>
                                  <th scope="col">food name</th>
                                  <th scope="col">food categories</th>
                                  <th scope="col">food description</th>
                                  <th scope="col">food original price</th>
                                  <th scope="col">food discounted price</th>
                                  <th scope="col">food availibility</th>
                                  <th scope="col">food veg nonveg</th>
                                  <th scope="col">food ingredients</th>

                                  <th scope="col">Edit</th>
                                  <th scope="col">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $count=0;
                                $res=mysqli_query($link,"select * from food");
                                while ($row=mysqli_fetch_array($res)) 
                                {
                                    $count=$count+1;
                                    echo "<tr>";
                                    echo "<td>"; echo $count;["id"]; echo "</td>";
                                    echo "<td>"; ?> <img src="<?php echo $row["food_image"] ?>"> <?php echo "</td>";
                                    echo "<td>"; echo $row["food_name"]; echo "</td>";
                                    echo "<td>"; echo $row["food_categories"]; echo "</td>";
                                    echo "<td>"; echo $row["food_description"]; echo "</td>";
                                    echo "<td>"; echo $row["food_original_price"]; echo "</td>";
                                    echo "<td>"; echo $row["food_discounted_price"]; echo "</td>";
                                    echo "<td>"; echo $row["food_availibility"]; echo "</td>";
                                    echo "<td>"; echo $row["food_veg_nonveg"]; echo "</td>";
                                    echo "<td>"; echo $row["food_ingredients"]; echo "</td>";

                                    echo "<td>"; ?> <a href="edit_food.php?id=<?php echo $row["id"]; ?>" style="color:green">Edit</a> <?php echo "</td>";
                                    echo "<td>"; ?> <a href="delete_food.php?id=<?php echo $row["id"]; ?>"style="color:red">Delete</a> <?php echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>




        </div>
<!--content area-->



<?php
include "footer.php";
?>
