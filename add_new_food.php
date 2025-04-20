<?php
session_start();
include "connection.php";
include "header.php";
?>
<link rel="stylesheet" href="cropping_css/croppie.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Add New Food</h1>
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
                    <strong class="card-title">Add New Food</strong>
                </div>
                <div class="card-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="alert alert-success" role="alert" id="success" style="display:none;">
                                Food Inserted Successfully
                            </div>
                            <div class="alert alert-danger" role="alert" id="error" style="display:none;">
                                Duplicate Food Found
                            </div>
                            <form name="form1" action="" method="post">
                                <div class="form-group">
                                    <div id="uploaded_image" style="cursor: pointer"
                                        onclick="document.getElementById('upload_image').click();">
                                        <img src="camera.jpg" id="image1" height="100" width="100">
                                    </div>
                                    <input type="file" name="upload_image" id="upload_image" style="display:none" required>
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Food Name</label>
                                    <input id="food_name" name="food_name" type="text" class="form-control"
                                        placeholder="Enter Food Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Food Category</label>
                                    <select name="food_categories" class="form-control" required>
                                        <?php
                                        $res = mysqli_query($link, "SELECT * FROM food_categories order by food_categories asc");
                                        while ($row = mysqli_fetch_array($res)) {
                                            echo "<option value=" . $row['food_categories'] . ">" . $row['food_categories'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Food Description</label>
                                    <textarea name="food_description" class="form-control"
                                        placeholder="Enter Food Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Food Original Price</label>
                                    <input id="food_original_price" name="food_original_price" type="text"
                                        class="form-control" placeholder="Enter Food Original Price">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Food Discount Price</label>
                                    <input id="food_discounted_price" name="food_discounted_price" type="text"
                                        class="form-control" placeholder="Enter Food Discount Price">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Food Availibility</label>
                                    <select name="food_availibility" class="form-control">
                                        <option>yes</option>
                                        <option>no</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Food Veg/Non-veg</label>
                                    <select name="food_veg_nonveg" class="form-control">
                                        <option>veg</option>
                                        <option>non veg</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $res = mysqli_query($link, "SELECT * FROM food_ingredients order by food_ingredients asc");
                                    while ($row = mysqli_fetch_array($res)) {
                                        ?>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="food_ingredients[]"
                                                value="<?php echo $row['food_ingredients']; ?>"> &nbsp;
                                            <?php echo $row['food_ingredients']; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"
                                        name="submit1">
                                        <span id="payment-button-amount">Submit</span>
                                    </button>
                                </div>
                                <br>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["submit1"])) {

    $ingredienst = "";
    $count = 0;
    if (isset($_POST['food_ingredients']) && is_array($_POST['food_ingredients'])) {
        foreach ($_POST['food_ingredients'] as $check) {
            $count++;
            if ($count == 1) {
                $ingredienst = $check;
            } else {
                $ingredienst = $ingredienst . "," . $check;
            }
        }
    }

    copy('temp_photo/' . $_SESSION["image_name01"], 'images/' . $_SESSION["image_name01"]);
    $dst1 = "images/" . $_SESSION["image_name01"];

    $res = mysqli_query($link, "select * from food where food_name='" . $_POST['food_name'] . "'") or die(mysqli_error($link));
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "block";
            document.getElementById("success").style.display = "none";
        </script>
        <?php
    } else {
        mysqli_query($link, "insert into food values(NULL, '$_POST[food_name]', '$_POST[food_categories]', '$_POST[food_description]', '$_POST[food_original_price]', '$_POST[food_discounted_price]', '$_POST[food_availibility]','$_POST[food_veg_nonveg]','$ingredienst','$dst1')") or die(mysqli_error($link));
        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "none";
            document.getElementById("success").style.display = "block";
        </script>
        <?php
    }

    unset($_SESSION["image_name01"]);
}
?>

<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog" style="width:auto">
        <div class="modal-content" style="width: 1000px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload & Crop Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px;"></div>

                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success crop_image">Crop & Upload Image</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    //https://foliotek.github.io/Croppie/
    $(document).ready(function () {
        $image_crop = $('#image_demo').croppie({
            enforceBoundary: false,
            enableOrientation: true,
            viewport: {
                width: 270,
                height: 230,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 250
            }
        });

        $('#upload_image').on('change', function () {

            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function (event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "crop_and_upload01.php",
                    type: "POST",
                    data: { "image": response },
                    success: function (data) {
                        $('#uploadimageModal').modal('hide');
                        $('#uploaded_image').html(data);
                    }
                });
            })
        });

    });
</script>
<script src="cropping_js/bootstrap.min.js"></script>
<script src="cropping_js/croppie.js"></script>
<script src="cropping_js/exif.js"></script>



<?php include "footer.php"; ?>