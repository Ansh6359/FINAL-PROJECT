<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_POST['content_id']) && isset($_POST['updated_content'])) {
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
    $updated_content = $_POST['updated_content'];

    // Update the content
    $query = "UPDATE content SET content = '$updated_content' WHERE content_id = $content_id";
    
    if (mysqli_query($conn, $query)) {
        echo "Content updated successfully!";
	 header("Location: about.php");
	exit();
    } else {
        echo "Error updating content: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
