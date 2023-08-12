<?php
session_start();




    $db_host = 'localhost:3312';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'crud_website';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);



if ((!isset($_SESSION["email"])) && ($_SERVER["REQUEST_METHOD"] == "POST") ) { 
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to check login credentials
    $query = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row["password"])) {
         $_SESSION['email'] = $email;
	 $_SESSION['password'] = $password;
	header("Location: home.php"); 
        exit();
	}else{
		$login_error = "Invalid email or password";
	}
        
    } else {
        $login_error = "Invalid email or password";
    }

    mysqli_close($conn);


}






if (isset($_SESSION['email']) && isset($_SESSION['password'])) {   
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $content = '';

                    $db_host = 'localhost:3312';
                    $db_user = 'root';
                    $db_pass = '';
                    $db_name = 'crud_website';

                    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Query to fetch data
                    $sql = "SELECT admin_id, name, email, image_name FROM admin";
                    $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
$content = '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';
                    // Display fetched data
                    while ($row = mysqli_fetch_assoc($result)) {
                        $content .= '<tr>';
                        $content .= '<td>' . $row['name'] . '</td>';
                        $content .= '<td>' . $row['email'] . '</td>';
                        $content .= '<td><img src="uploads/' . $row['image_name'] . '" width="50" height="50"></td>';
                        $content .= '<td>';
                        $content .= '<a href="update_admin.php?id=' . $row['admin_id'] . '">Update</a> | ';
                        $content .= '<a href="delete_admin.php?id=' . $row['admin_id'] . '">Delete</a>';
                        $content .= '</td>';
                        $content .= '</tr>';
                    }

                $content .= '</tbody>
            </table>';
}


else{
	$content ='<h2 class="center">No Rows available</h2>';
}

} else {
    $content = '<h2 id="register">Register</h2>
            <form method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name = "email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="nav-link" href="register.php">New User? Register Yourself</a>
            </form>';
}
include "header.php"; 
echo '


<div class="container mt-4 mid_content">
    <div class="row">
        <div class="col-md-12">
           '.$content.'
        </div>
    </div>
</div>
';
?>
<?php include "footer.php"; ?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


