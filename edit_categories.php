<?php
include "connection.php" ;
include "header.php";
$id=$_GET["id"];
$category_name="";
$res=mysqli_query($link,"select * from food_categories where id=$id");
while($row=mysqli_fetch_array($res))
{
    $category_name=$row["food_categories"];
}
?>
<!--content area-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add/Edit categories</h1>
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
                        <div class="card-header">
                            <strong class="card-title">Add/Edit categories </strong>
                        </div>
                        <div class="card-body">
                          <!-- Credit Card -->
                          <div id="pay-invoice">
                             
                              <form name="form1" action="" method="post">
                                      <div class="form-group">
                                          <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                          <input id="food_category" name="food_category" type="text" class="form-control" placeholder="Enter Category" required value="<?php echo $category_name; ?>">  
                                      </div>
                                  
                                  
                                      <div>
                                          <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit1">

                                          <span id="payment-button-amount">Update</span>
                                          </button>
                                      </div>
                                      <br>
                                      <div class="alert alert-success" role="alert" id="success" style="display:none;">
                                           Categories Updated Successfully
                                        </div>
                                        <div class="alert alert-danger" role="alert" id="error" style="display:none;">
                                            Duplicate Categories Found
                                        </div>
                                  </form>
                              </div>
                          </div>

                        </div>
                    </div> <!-- .card -->
            </div>
             
            


        </div>
<!--content area-->

<?php
if (isset($_POST["submit1"]))
{
    $count=0;
    $res=mysqli_query($link,"select * from food_categories where food_categories='$_POST[food_category]'") or die(mysqli_error($link));
    $count=mysqli_num_rows($res);
    if($count>0)
    {
        ?>
            <script type="text/javascript">
            document.getElementById("error").style.display="block";
            document.getElementById("success").style.display="none";
            </script>
        <?php
    }
    else
    {
        mysqli_query($link,"update food_categories set food_categories='$_POST[food_category]' where id=$id") or die(mysqli_error($link));
        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display="none";
            document.getElementById("success").style.display="block";
        </script>
            <?php
    }
    ?>
        <script type="text/javascript">
        setTimeout(function(){
                window.location="food_categories.php";
            },1000);
        </script>
    <?php
}
?>

<?php
include "footer.php";
?>
