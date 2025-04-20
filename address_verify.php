<?php
session_start();
include 'header.php';
include "../admin/connection.php";
$_SESSION["address_verify"]="yes";
?>
	
<?php
$firstname="";
$lastname="";
$email="";
$contact="";
$address="";
$res=mysqli_query($link,"select * from user_registration where username='$_SESSION[user_username]'");
while($row=mysqli_fetch_array($res))
{
    $firstname=$row["firstname"];
    $lastname=$row["lastname"];
    $email=$row["email"];
    $contact=$row["contact"];
    $address=$row["address"];
}


?>
  <!-- Checkout Page -->
  <div class="checkout-page">
            <div class="auto-container">

                <!--Default Links-->


                <!--Billing Details-->
                <div class="billing-details">
                    <div class="shop-form">
                        <form method="post" action="" name="form1">
                            <div class="row clearfix">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6 col-md-12 col-sm-12" style="border-style: solid; border-width: 1px; border-radius:5px;border-color: #c62904; padding:20px;">

                                    <div class="sec-title">
                                        <h2>Address Verification</h2>
                                    </div>
                                    <div class="billing-inner">
                                        <div class="row clearfix">

                                   

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">First Name</div>
                                                <input type="text" name="firstname" value="<?php echo $firstname; ?>"
                                                    placeholder="Firstname">
                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Last Name</div>
                                                <input type="text" name="lastname" value="<?php echo $lastname; ?>"
                                                       placeholder="LastName">
                                            </div>

                                           

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Email</div>
                                                <input type="text" name="email" value="<?php echo $email; ?>"
                                                       placeholder="Email">
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Contact Number</div>
                                                <input type="text" name="contact" value="<?php echo $contact; ?>"
                                                       placeholder="Contact Number">
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Address</div>
                                                <textarea name="address" placeholder="Address"><?php echo $address; ?></textarea>
                                            </div>


                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                <button type="submit" class="theme-btn btn-style-five" name="verify"><span
                                                        class="txt">Verify</span></button>
                                            </div>

                                        </div>
                                    </div>
                                 
                                </div>


                            </div>
                        </form>

                    </div>

                </div>
                <!--End Billing Details-->
            </div>
        </div>

<?php

$actual_link='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$url=explode('/',$actual_link);
array_pop($url);
$url=implode('/',$url)."/order_success.php";
$pay=$_SESSION["sub_total"];
$orderno=rand(111111,999999);
$_SESSION["orderno"]=$orderno;

if(isset($_POST["verify"]))
{
     mysqli_query($link,"update user_registration set firstname='$_POST[firstname]',lastname='$_POST[lastname]',email='$_POST[email]',contact='$_POST[contact]',address='$_POST[address]' where username='$_SESSION[user_username]'");
     
     if($_SESSION["payment_type"]=="cod")
     {
        ?>
        <script type="text/javascript">
            window.location="<?php echo $url ?>?orderno=<?php echo $orderno; ?>";
        </script>
        <?php
     }
else {
    ?>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="buyCredits" id="buyCredits">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="amit_1266030690_per@gmail.com">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="item_name" value="payment for food">
    <input type="hidden" name="item_number" value="">
    <input type="hidden" name="amount" value="<?php echo $pay; ?>">
    <input type="hidden" name="return" value="<?php echo $url; ?>?orderno=<?php echo $orderno; ?>">
</form>
<script type="text/javascript">
    document.getElementById("buyCredits").submit();
</script>
<?php
}
}
?>

<?php

include 'footer.php';
?>	

