<?php

$db_host = 'localhost:3312';
$db_user = 'root';
$db_pass = '';
$db_name = 'crud_website';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $admin_id = $_POST['admin_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Update the admin record
    $update_sql = "UPDATE admin SET name = '$name', email = '$email' WHERE admin_id = '$admin_id'";

    if (mysqli_query($conn, $update_sql)) {
        echo "Admin updated successfully!";
	header("Location: home.php");
    } else {
        echo "Error: " . mysqli_error($conn);
	header("Location: home.php");
    }
}





// Check if admin_id is provided in URL parameter
if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Retrieve admin record based on admin_id
    $select_sql = "SELECT * FROM admin WHERE admin_id = '$admin_id'";
    $result = mysqli_query($conn, $select_sql);
    $row = mysqli_fetch_assoc($result);
    include "header.php"; 
    // Display the update form
    echo '


    
    <div class="container mt-4 mid_content">
        <div class="row">
            <div class="col-md-12">
                <h2>Update Admin</h2>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="admin_id" value="' . $row['admin_id'] . '">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="' . $row['name'] . '" required><br>
                    
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="' . $row['email'] . '" required><br>
                    
                    <label for="image">Profile Image:</label>
                    <input type="file" name="image"><br>
                    
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    
    ';
}
?>

<?php include "footer.php"; ?>


</body>
    </html>
<?php 

mysqli_close($conn);
?>
