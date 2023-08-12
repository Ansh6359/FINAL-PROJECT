<?php
session_start();
include "header.php";
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

    // Fetch the content
    $query = "SELECT content FROM content WHERE content_id = $content_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $content = $row['content'];

        // Display update form
        echo '<form action="update_process.php" method="post">
                <input type="hidden" name="content_id" value="' . $content_id . '">
                <textarea name="updated_content" rows="30" cols="45">' . $content . '</textarea>
                <button type="submit">Update Content</button>
              </form>';
    }

    mysqli_close($conn);
}
include "footer.php";
?>
