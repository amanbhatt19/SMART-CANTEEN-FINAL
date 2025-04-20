<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include necessary files
include 'header.php';
include 'slider.php';
include '../admin/connection.php'; // Ensure this file contains the correct database connection code

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into the database
    $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Message sent successfully!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['message'] = "Error sending message: " . mysqli_error($conn);
        header("Location: contact.php");
        exit();
    }
}
?>

<!-- HTML Structure -->
<div class="form-column col-lg-8 col-md-12 col-sm-12">
    <div class="inner-column">
        <div class="title-box">
            <h3>We Love To Hear From You</h3>
            <div class="text">If it's not too much trouble informed us regarding whether you have an
                inquiry, need to leave a remark, or might want additional data about Advotis</div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            <form method="post" action="" id="contact-form">
                <div class="row clearfix">
                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                        <input type="text" name="username" value="" placeholder="Name" required>
                    </div>
                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                        <input type="email" name="email" value="" placeholder="Email" required>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <input type="text" name="subject" value="" placeholder="Subject" required>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <textarea name="message" placeholder="Message" required></textarea>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <button type="submit" class="theme-btn btn-style-five"><span class="txt">Submit</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Info Column -->
<div class="info-column col-lg-4 col-md-12 col-sm-12">
    <div class="inner-column">
        <h3>Our Address</h3>
        <ul>
            <li><strong>GLS University</strong> GLS Campus, Opp. Law Garden, Ellisbridge, Ahmedabad – 380006.</li>
            <li><strong>Have any query:</strong> Call us on: +91 7926440532</li>
        </ul>
    </div>
</div>

<?php
include 'footer.php';
ob_end_flush(); // End output buffering
?>