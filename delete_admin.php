<?php
// Database connection
$db_host = 'localhost:3312';
$db_user = 'root';
$db_pass = '';
$db_name = 'crud_website';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if admin_id is available in URL.
if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Delete the admin record
    $delete_sql = "DELETE FROM admin WHERE admin_id = '$admin_id'";

    if (mysqli_query($conn, $delete_sql)) {
        echo "Admin deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

// Redirect to home page
header("Location: home.php");
exit();
?>
