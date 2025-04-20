<?php
session_start();
include "header.php";
//include "slider.php";
?>

<section class="products-section">
    <div class="auto-container">

        <?php
        if(!isset($_SESSION["order_complete_msg"]))
        {
            ?>
            <script type="text/javascript">
                window.location="index.php";
            </script>
        <?php
        }
        else {
        ?>
            <div class="col-xl-10 col-lg-12 m-auto" style="text-align: center">
                <img src="right1.png">

                <h3 style="text-align: center">Your Order Placed Successfully.</h3>
            </div>
            <?php
            unset($_SESSION["order_complete_msg"]);
        }
        ?>
    </div>
</section>



<?php
include "service_section.php";
include "footer.php";
?>





