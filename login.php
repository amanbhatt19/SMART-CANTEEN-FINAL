<?php
session_start();
include "../admin/connection.php";
include 'header.php';
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
                                        <h2>Login Page</h2>
                                    </div>
                                    <div class="billing-inner">
                                        <div class="row clearfix">


                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="alert alert-danger col-md-12" id="errmsg" style="display: none">
                                                <strong>Invalid!</strong><span style="color"red>Username or Password. </span>
                                        </div>
                                        </div>

                            
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">UserName</div>
                                                <input type="text" name="username" value=""
                                                    placeholder="User Name">
                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Password</div>
                                                <input type="password" name="password" value=""
                                                       placeholder="Password">
                                            </div>


                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                <button type="submit" class="theme-btn btn-style-five" name="login"><span
                                                        class="txt">Login</span></button>
                                            </div>

                                        </div>
                                    </div>
                                    <ul class="default-links">
                                        <li>New User? <a href="register.php" data-toggle="modal" data-target="#schedule-box" onclick="window.location='register.php';">Click here to
                                            Register</a></li>
                                    </ul>
                                </div>


                            </div>
                        </form>

                    </div>

                </div>
                <!--End Billing Details-->
            </div>
        </div>

<?php
if(isset($_POST["login"]))
{
    $res = mysqli_query($link, "select * from user_registration where username='$_POST[username]' && password='$_POST[password]'");
    $count=0;
    while($row=mysqli_fetch_array($res))
    {
        $user_fullname=$row["firstname"]." ".$row["lastname"];
        $_SESSION["user_username"]=$row["username"];
        $count=1;

        if(isset($_SESSION['checkout']))
        {
            ?>
            <script type="text/javascript">
                window.location="checkout.php";
            </script>
            <?php
        }
        else
        {
            ?>
            <script type="text/javascript">
                window.location="view_my_order.php";
            </script>
            <?php
        }
        
    }
    if($count==0)
    {
        ?>
        <script type="text/javascript">
            document.getElementById("errmsg").style.display="block";
        </script>
        <?php
    }
    else{
        ?>
        <script type="text/javascript">
            document.getElementById("errmsg").style.display="none";
        </script>
        <?php
    }
}
?>

	
<?php

include 'footer.php';
?>	

