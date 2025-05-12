<?php
session_start(); // Start the session to manage cart


header('Content-Type: application/json'); // Set response content type to JSON

echo json_encode(isset($_SESSION['cart']) ? $_SESSION['cart'] : []); // Return cart items or empty array
