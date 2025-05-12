<?php
include("connection.php");

if(isset($_POST['rating']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];

    // Update the product rating (average logic can be improved)
    $update_rating = mysqli_query($conn, "UPDATE menu_items SET rating = (rating + $rating) / 2 WHERE id = '$product_id'");

    if($update_rating){
        echo "<script>alert('Rating submitted!'); window.location.href='menu3.php';</script>";
    } else {
        echo "<script>alert('Error submitting rating.'); window.location.href='menu3.php';</script>";
    }
}
?>
