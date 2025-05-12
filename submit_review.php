<!-- PHP: submit_review.php (Handles Form Submission) -->
<?php
include 'connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $review = $_POST['rev'];
    $rating = $_POST['desc'];
    
    $sql = "INSERT INTO review (name, review, description) VALUES ('$name', '$review', '$rating')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Review submitted successfully!'); window.location.href='menu3.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>