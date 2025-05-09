<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$id = $_GET["id"];
$qty_get = $_GET["qty"];
include "../admin/connection.php";

$food_img = "";
$food_name = "";
$food_price = "";
$qty = "";
$total = "";
$tb_id = "";

$res3 = mysqli_query($link, "select * from food WHERE id='$id'");
if ($res3 && mysqli_num_rows($res3) > 0) { // Check if query was successful and returned rows
    while ($row3 = mysqli_fetch_array($res3)) {
        $food_img = $row3["food_image"];
        $food_name = $row3["food_name"];
        $tb_id = $row3["id"];
        if (isset($row3["food_original_price"])) { // Check if the key exists before accessing it
            $food_price = $row3["food_original_price"];
        } else {
            // Handle the case where "food_discount_price" is not set.
            // You might want to use a default value or log an error.
            $food_price = 0; // Or any other default value
            error_log("Warning: food_original_price not found for food ID: " . $id); // Log the error
        }
    }

    $check_available = 0;
    $check_available = check_duplicate_product_single($tb_id);
    $available_qty = 0;
    $check_the_qty = 0;
    if ($check_available == 0) {
        if (isset($_SESSION['cart'])) {
            $b = array("img1" => $food_img, "nm" => $food_name, "price" => $food_price, "qty_total" => $qty_get, "tb_id" => $tb_id);
            array_push($_SESSION['cart'], $b);
            echo "Product Successfully Added To Cart01";
        } else {
            $_SESSION['cart'] = array(array("img1" => $food_img, "nm" => $food_name, "price" => $food_price, "qty_total" => $qty_get, "tb_id" => $tb_id));
            echo "Product Successfully Added To Cart02";
        }
    } else {
        $qty_exist_in_cart_for_this_product = check_the_qty_single($tb_id);
        $qty_get = $qty_get + $qty_exist_in_cart_for_this_product;

        if (isset($_SESSION['cart'])) {
            $check_product_no_session = check_product_no_session_single($tb_id);
            $b = array("img1" => $food_img, "nm" => $food_name, "price" => $food_price, "qty_total" => $qty_get, "tb_id" => $tb_id);
            $_SESSION['cart'][$check_product_no_session] = $b;
            echo "Product Successfully Added To Cart044";
        } else {
            $_SESSION['cart'] = array(array("img1" => $food_img, "nm" => $food_name, "price" => $food_price, "qty_total" => $qty_get, "tb_id" => $tb_id));
            echo "Product Successfully Added To Cart05";
        }
    }
} else {
    echo "Error: Food item not found."; // Handle the case where the query fails or returns no rows.
    error_log("Error: Food Item not found for ID: " . $id . ". Query: " . mysqli_error($link));
}

function check_duplicate_product_single($tb_id)
{
    $found = 0;
    $max = 0;
    if (isset($_SESSION['cart'])) {
        $max = sizeof($_SESSION['cart']);
    }

    for ($i = 0; $i < $max; $i++) {
        if (isset($_SESSION['cart'][$i])) {
            $tb_id_session = "";

            foreach ($_SESSION['cart'][$i] as $key => $val) {
                if ($key == "tb_id") {
                    $tb_id_session = $val;
                }
            }
            if ($tb_id_session == $tb_id) {
                $found = $found + 1;
            }
        }
    }
    return $found;
}

function check_the_qty_single($tb_id)
{
    $qty_found = 0;
    $max = sizeof($_SESSION['cart']);
    for ($i = 0; $i < $max; $i++) {
        $tb_id_session = "";
        $qty_total_session = "";

        if (isset($_SESSION['cart'][$i])) {
            foreach ($_SESSION['cart'][$i] as $key => $val) {
                if ($key == "tb_id") {
                    $tb_id_session = $val;
                }
                if ($key == "qty_total") {
                    $qty_total_session = $val;
                }
            }
            if ($tb_id_session == $tb_id) {
                $qty_found = $qty_total_session;
            }
        }
    }
    return $qty_found;
}

function check_product_no_session_single($tb_id)
{
    $recordno = 0;
    $max = sizeof($_SESSION['cart']);
    for ($i = 0; $i < $max; $i++) {
        if (isset($_SESSION['cart'][$i])) {
            $tb_id_session = "";

            foreach ($_SESSION['cart'][$i] as $key => $val) {
                if ($key == "tb_id") {
                    $tb_id_session = $val;
                }
            }
            if ($tb_id_session == $tb_id) {
                $recordno = $i;
            }
        }
    }
    return $recordno;
}
?>