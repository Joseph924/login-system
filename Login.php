<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Connect to the database and retrieve the user's information
  $host = 'localhost';
  $user = 'root';
  $password_db = '';
  $db_name = 'form';

  $conn = mysqli_connect($host, $user, $password_db, $db_name);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $query = "SELECT id, name, email, password FROM users WHERE email = '$email' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
      // If the email and password match, set the session variables and redirect to the home page
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['name'];
      header('Location: home.php');
      exit();
    } else {
      // If the password is incorrect, display an error message
      $error = 'Incorrect password';
    }
  } else {
    // If the email is not found in the database, display an error message
    $error = 'Email not found';
  }

  mysqli_close($conn);
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Login.css">

</head>

<body>
    <header>
        <div class="container">
            <h3 class="page-header">login page</h3>
            <p class="mgs">Welcome to our page please login below
            </p>
    </header>

    </div>
    
         <form method="post" action="Login.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
            <?php if (isset($error)) { ?>
              <br><br>
              <div style="color: red;"><?php echo $error; ?></div>
            <?php } ?>
          </form>
          <div class="forgot-password">
          <a href="forgotpass.php">Forgot Password?</a>
    
    </form>
 
</body>

</html>