<?php
if(!isset($_SESSION))
{
    session_start();
}
?>

<?php
include 'header.php';
include "../admin/connection.php";
//include 'slider.php';
?>
	
<section class="products-section">
	<div class="auto-container">
	
   <!-- sec title -->
	   <div class="sec-title centered">
		   <h2>My Order</h2>
	   </div>

       <table class="table table-bordered">
        <tr style="background-color: #A41A13; color: white; text-align: center;">   
            <th>Sr No.</th> 
            <th>Order Number</th>
            <th>Order Date</th>
            <th>Order Time</th>
            <th>Order Address</th>
            <th>Order Type</th>
            <th>Order Status</th>
            <th>Order Details</th>
        </tr>

        <?php
        $srno=0;
        $res=mysqli_query($link,"select * from order_main where order_username='$_SESSION[user_username]' order by id desc");
        $srno=mysqli_num_rows($res);
        while($row=mysqli_fetch_array($res))
        {
            echo "<tr>";
            echo "<td>"; echo $srno; echo "</td>";
            echo "<td>"; echo $row["order_number"]; echo "</td>";
            echo "<td>"; echo $row["order_date"]; echo "</td>";
            echo "<td>"; echo $row["order_time"]; echo "</td>";
            echo "<td>"; echo $row["order_address"]; echo "</td>";
            echo "<td>"; echo $row["order_type"]; echo "</td>";
            echo "<td>"; echo $row["order_status"]; echo "</td>";
            echo "<td>"; ?>
                <a href="order_details.php?id=<?php echo $row["id"]; ?>">Order Details</a> <?php echo "</td>";
            echo "</tr>";
            $srno=$srno-1;
           

        }
        ?>
        </table>

	   </div>
	   </section>

	
<?php

include 'footer.php';
?>	

