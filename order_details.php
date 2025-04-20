<?php
if(!isset($_SESSION))
{
    session_start();

}
?>
<?php 
include "../admin/connection.php";
include "header.php";
//include 'slider.php';
if (!isset($_GET['id'])) {
    die("ID parameter is missing in the URL.");
}
$id = $_GET['id'];
$full_name="";
$contact_number="";
$order_date="";
$email="";
$order_type="";
$order_status="";   
$order_number="";
$address="";

$res = mysqli_query($link, "select * from order_main where id=$id");
if (!$res) {
    die("Query failed: " . mysqli_error($link));
}
while($row=mysqli_fetch_array($res))
{
    $full_name=$row["user_firstname"]." ".$row["user_lastname"];
    $contact_number=$row["user_contact"];
    $order_date=$row["order_date"]." ".$row["order_time"];
    $email=$row["user_email"];
    $order_type=$row["order_type"];
    $order_status=$row["order_status"];
    $order_number=$row["order_number"];
    $address=$row["order_address"];
}
?>
	
<section class="products-section">
	<div class="auto-container">
	
   <!-- sec title -->
	   <div class="sec-title centered">
		   <h2>Order Detail</h2>
	   </div>

       <div class="row" style="margin-top: 10px">
        <div class="col-lg-6">
            Customer Name : <?php echo $full_name; ?><br>
            Contact Number : <?php echo $contact_number; ?><br>
            Order Date: <?php echo $order_date; ?><br>
            Email : <?php echo $email; ?><br>
            Address: <?php echo $address; ?><br>
        </div>
        <div class="col-lg-6" style="text-align: right;">
            Order Number : <?php echo $order_number; ?><br>
            Order Type : <?php echo $order_type; ?><br>
            Order Status : <?php echo $order_status; ?><br>
       </div>
       </div>
       <div class="billing-inner" style="margin-top: 10px">
            <table class="table table-bordered" style="margin-top: 10px">
                    <tr>
                        <th>Sr No.</th>
                        <th>Image</th>
                        <th>Food Name</th>
                        <th>Food Category</th>
                        <th>Food Description</th>
                        <th>Food Price</th>
                        <th>Food Qty</th>
                        <th>Veg/Non Veg</th>
                    </tr>
<?php
$srno=0;
$tot=0;
$res=mysqli_query($link,"select * from order_details where order_id=$id");
while($row=mysqli_fetch_array($res))
{
    $srno=$srno+1;
    echo "<tr>";
    echo "<td>"; echo $srno; echo "</td>";
    echo "<td>"; ?> <img src="../admin/<?php echo $row["food_image"]; ?>" height="100" width="100"> <?php echo "</td>";
    echo "<td>"; echo $row["food_name"]; echo "</td>";
    echo "<td>"; echo $row["food_category"]; echo "</td>";
    echo "<td>"; echo $row["food_description"]; echo "</td>";
    echo "<td>"; echo $row["food_ingredients"]; echo "</td>";
    echo "<td>"; echo $row["food_original_price"]; echo "</td>";
    echo "<td>"; echo $row["food_qty"]; echo "</td>";
    echo "<td>"; echo $row["food_veg_nonveg"]; echo "</td>";



    echo "</tr>";
    $tot=$tot+($row["food_original_price"]*$row["food_qty"]);
}
?>

                </table>
                <div style="float: right;">
                    Total:₹<?php echo $tot; ?>
                </div>
                </div>

	   </div>
	   </section>

	
<?php
include "service_section.php";
include "footer.php";
?>	

