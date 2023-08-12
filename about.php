<?php
session_start();
include "header.php"; // Include the header

$content = '
<div class="container mt-4 mid_content">
    <div class="row">
        <div class="col-md-12">
';

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $db_host = 'localhost:3312';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'crud_website';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch the content from the database
    $query = "SELECT content, content_id FROM content"; 
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $content_id = $row['content_id'];
            $content .= '<p>' . $row['content'] . '</p>';
            $content .= '<br>
            <form action="update_content.php" method="post" style="display: inline;">
                <input type="hidden" name="content_id" value="' . $content_id . '">
                <button type="submit" class="btn btn-primary">Update</button>
            </form> 
            <form action="delete_content.php" method="post" style="display: inline;">
                <input type="hidden" name="content_id" value="' . $content_id . '">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form> <br><br><br><br><br><br>';
        }
    } else {
        $content .= "Content not found.";
    }

    mysqli_close($conn);
} else {
    $content .= "<h2 class='center'>You have not logged in yet!</h2>";
}

$content .= '
        </div>
    </div>
</div>
';

echo $content;

include "footer.php"; // Include the footer
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>';
?>
