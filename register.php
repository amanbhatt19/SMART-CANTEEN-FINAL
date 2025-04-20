<?php
include 'header.php';
include "../admin/connection.php";
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
                                        <h2>Registration Page</h2>
                                    </div>
                                    <div class="billing-inner">
                                        <div class="row clearfix">

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="alert alert-danger col-md-12" id="errmsg" style="display: none">
                                                <strong>Invalid!</strong><span style="color"red>This username already exist. </span>
                                        </div>
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="alert alert-success col-md-12" id="sucess" style="display: none">
                                                <strong>Sucess!</strong><span style="color"green>User Inserted Successfully. </span>
                                        </div>
                                        </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">First Name</div>
                                                <input type="text" name="firstname" value=""
                                                    placeholder="Firstname">
                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Last Name</div>
                                                <input type="text" name="lastname" value=""
                                                       placeholder="LastName">
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">UserName</div>
                                                <input type="text" name="username" value=""
                                                       placeholder="UserName">
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Password</div>
                                                <input type="password" name="password" value=""
                                                       placeholder="Password">
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Email</div>
                                                <input type="text" name="email" value=""
                                                       placeholder="Email">
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Contact Number</div>
                                                <input type="text" name="contact" value=""
                                                       placeholder="Contact Number">
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Address</div>
                                                <textarea name="address" placeholder="Address"></textarea>
                                            </div>


                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                <button type="submit" class="theme-btn btn-style-five" name="register"><span
                                                        class="txt">Register</span></button>
                                            </div>

                                        </div>
                                    </div>
                                    <ul class="default-links">
                                        <li>New User? <a href="login.php" data-toggle="modal" data-target="#schedule-box" onclick="window.location='login.php';">Click here to
                                            Login</a></li>
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
if(isset($POST["register"]))
{
    $count=0;
    $res=mysqli_query($link,"select * from user_registration where username='$_POST[username]'");
    $count=mysqli_num_rows($res);

    if($count>0)
    {
        ?>
        <script type="text/javascript">
            document.getElementById("errmsg").style.display="block";
        </script>
        <?php
    }
    else{
        mysqli_query($link,"insert into user_registration(id,firstname,lastname,username,password,email,contact,address)values(NULL,'$_POST[firstname]','$_POST[lastname]','$_POST[username]','$_POST[password]','$_POST[email]','$_POST[contact]','$_POST[address]')");
        ?>
        <script type="text/javascript">
            document.getElementById("sucess").style.display="block";
            setTimeout(function(){
                window.location="login.php";
            },2000);
        </script>
        <?php
    }
}

?>

<?php
include 'delivery_section.php';
include 'service_section.php';
include 'footer.php';
?>	

