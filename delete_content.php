<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_POST['content_id'])) {
    // Connect to the database
    $db_host = 'localhost:3312';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'crud_website';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $content_id = $_POST['content_id'];

    // Delete the content
    $query = "DELETE FROM content WHERE content_id = $content_id";
    
    if (mysqli_query($conn, $query)) {
        echo "Content deleted successfully!";
    } else {
        echo "Error deleting content: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: about.php");
}
?>
