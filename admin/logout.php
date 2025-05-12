<?php
session_start();

// Destroy all sessions
session_unset();
session_destroy();

// Redirect based on previous session
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: adminlogin.php');
} else {
    header('Location: adminlogin.php');
}

exit;
?>
