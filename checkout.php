<?php
session_start();
include "../admin/connection.php";
?>
<?php
if(!isset($_SESSION["cart_count"]))
{
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
    }
else if($_SESSION["cart_count"]==0)
{
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}
else{
    $_SESSION["checkout"]="yes";
    $_SESSION["cart_item"]="yes";
    if(!isset($_SESSION["user_username"]))
    {
        ?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
        <?php
        }
        else{
            ?>
            <script type="text/javascript">
            window.location="address_verify.php";
            </script>
            <?php
        }
    }
?>