<?php
include "connection.php";
include "header.php";
?>
<!--content area-->

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Add/Edit Ingredients</h1>
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
                    <strong class="card-title">Add/Edit Ingredients</strong>
                </div>
                <div class="card-body">
                    <!-- Credit Card -->
                    <div id="pay-invoice">
                        <form name="form1" action="" method="post">
                            <div class="form-group">
                                <label for="ingredients_name" class="control-label mb-1">Ingredients Name</label>
                                <input id="ingredients_name" name="ingredients_name" type="text" class="form-control" placeholder="Enter Ingredient" required>
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit1">
                                    <span id="payment-button-amount">Submit</span>
                                </button>
                            </div>
                            <br>
                            <div class="alert alert-success" role="alert" id="success" style="display:none;">
                                Ingredients Inserted Successfully
                            </div>
                            <div class="alert alert-danger" role="alert" id="error" style="display:none;">
                                Duplicate Ingredients Found
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Food Ingredients</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ingredients</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $res = mysqli_query($link, "SELECT * FROM food_ingredients");
                            while ($row = mysqli_fetch_array($res)) {
                                $count++;
                                echo "<tr>";
                                echo "<td>$count</td>";
                                echo "<td>" . htmlspecialchars($row["food_ingredients"]) . "</td>";
                                echo "<td><a href='edit_ingredients.php?id=" . $row["id"] . "' style='color:green'>Edit</a></td>";
                                echo "<td><a href='delete_ingredients.php?id=" . $row["id"] . "' style='color:red'>Delete</a></td>";
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

<!-- Processing Form Submission -->
<?php
if (isset($_POST["submit1"]))
{
$count=0;
$res=mysqli_query($link, "select * from food_ingredients where food_ingredients='$_POST[ingredients_name]'") or die(mysqli_error($link));
$count=mysqli_num_rows($res);
if ($count>0)
{
?>
<script type="text/javascript">
document.getElementById("error").style.display="block";
document.getElementById("success").style.display="none";
</script>
<?php
}
else {
mysqli_query($link, "insert into food_ingredients values (NULL, '$_POST[ingredients_name]')") or die(mysqli_error($link));
?>
<script type="text/javascript">
document.getElementById("error").style.display="none";
document.getElementById("success").style.display="block";
</script>
<?php
}
?>
<script type="text/javascript">
setTimeout(function() {
window.location.href=window.location.href;
}, 1000);
</script>
<?php
}
?>

<?php include "footer.php"; ?>
