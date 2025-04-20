<?php
include 'header.php';
include "../admin/connection.php";
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
<?php
$id = $_GET["id"];
$food_name = "";
$food_description = "";
$food_price = "";
$food_image = "";
$food_ingredients = "";
$food_categories = "";
$res = mysqli_query($link, "select * from food where id=$id");
while ($row = mysqli_fetch_array($res)) {
    $food_name = $row["food_name"];
    $food_description = $row["food_description"];
    $food_price = $row["food_original_price"];
    $food_image = $row["food_image"];
    $food_ingredients = $row["food_ingredients"];
    $food_categories = $row["food_categories"];
}

?>
<title>Smart Canteen</title>

<section class="page-title" style="background-image: url(assets/images/background/11.jpg)">
    <div class="auto-container">
        <h1>Food Details</h1>

    </div>
</section>

<!--Shop Single Section-->
<section class="shop-single-section">
    <div class="auto-container">

        <div class="shop-single">
            <div class="product-details">

                <!--Basic Details-->
                <div class="basic-details">
                    <div class="row clearfix">
                        <div class="image-column col-lg-6 col-md-12 col-sm-12">
                            <figure class="image-box"><a href="#" class="lightbox-image" title="Image Caption Here"><img
                                        src="../admin/<?php echo $food_image; ?>" alt=""></a></figure>
                        </div>
                        <div class="info-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <h2><?php echo $food_name; ?></h2>
                                <div class="text"><?php echo $food_description ?></div>
                                <div class="price">Price : <span>₹<?php echo $food_price ?></span></div>

                                <div class="other-options clearfix">
                                    <div class="item-quantity"><label class="field-label">Quantity
                                            :</label><input class="quantity-spinner" type="text" value="1"
                                            name="quantity" id="qty"></div>
                                    <button type="button" name="submit1" class="theme-btn btn-style-five"
                                        onclick="add_to_cart('<?php echo $id ?>',document.getElementById('qty').value);"><span
                                            class="txt">Add
                                            to cart</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Basic Details-->


            </div>
        </div>

    </div>
</section>
<!--End Shop Single Section-->


<!-- Similar Products Section -->
<section class="similar-products-section">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <h2>Similar Products</h2><br>
        </div>
        <div class="row clearfix">

            <?php
            $res = mysqli_query($link, "select * from food where food_categories='$food_categories' && id!=$id");
            while ($row = mysqli_fetch_array($res)) {
                ?>
                <div class="product-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
            <figure class="image-box">
                <img src="../admin/<?php echo $row["food_image"] ?>" alt="">
            </figure>
            <div class="lower-content">
                <h4><a href="food_description.php?id=<?php echo $row["id"]; ?>"><?php echo $row["food_name"]; ?></a></h4>
                <div class="text"><?php echo substr($row["food_description"], 0, 30); ?>..</div>
                <div class="price">₹<?php echo $row["food_original_price"]; ?></div>
                <div class="lower-box">
                    <a href="food_description.php?id=<?php echo $row["id"]; ?>" class="theme-btn btn-style-five"><span
                            class="txt">Order
                            Now</span></a>
                </div>
            </div>
        </div>
        </div>
        <?php
            }
            ?>


    </div>
    </div>
</section>
<!-- End Similar Products Section -->

<script type="text/javascript">
    function add_to_cart(id, qty) {
        var xmlhttp1 = new XMLHttpRequest();
        xmlhttp1.onreadystatechange = function () {
            if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
                alert(xmlhttp1.responseText);
                window.location = "view_cart.php";
            }
        };
        xmlhttp1.open("GET", "add_to_cart.php?id=" + id + "&qty=" + qty, true);
        xmlhttp1.send();
    }
</script>

<?php
// include 'delivery_section.php';
// include 'service_section.php';
include 'footer.php';
?>

<!--Scroll to top-->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/parallax.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.fancybox.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/jquery.bootstrap-touchspin.js"></script>
<script src="assets/js/appear.js"></script>
<script src="assets/js/script.js"></script>