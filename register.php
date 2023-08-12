<?php
session_start();


    $msg= ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

if($re_password != $password){
  $msg= "Password and confirm password is not same, Please use same password!";
}else{
  if($name !='' && $email !='' && $password !=''){
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $image_name = '';
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "uploads/$image_name");
    }

   
    $db_host = 'localhost:3312';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'crud_website';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

   $sql = "INSERT INTO admin (name, email, password, image_name) VALUES ('$name', '$email', '$hashedPassword', '$image_name')";

	session_start();
	$_SESSION['email'] = $email;
	$_SESSION['password'] = $hashedPassword;

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";

	header("Location: home.php"); // Redirect to a success page
        exit();
    } else {
        $msg=  "Error Occured. Email should be unique email. Try again with different email.";
    }

    mysqli_close($conn);
  }
}
}


if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $content = '<h2 class="center">Hello, '.$email.' You have been Already registered !</h2>';
} else {
	$content = '<form method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="re_password">Confirm Password:</label>
        <input type="password" name="re_password" required><br>
        
        <label for="image">Profile Image:</label>
        <input type="file" name="image"><br>
        
        <button type="submit">Register</button>
    </form>';
}
include "header.php"; 
echo '


<div class="container mt-4 mid_content">
    <div class="row">
        <div class="col-md-12">
           '.$content.' <br> '.$msg.'
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
';

