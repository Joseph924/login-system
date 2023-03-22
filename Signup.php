<?php
// Connect to MySQL database
$host = "localhost";
$username = "root";
$password = "";
$database = "form";
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Store information in database
  $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
  if (mysqli_query($conn, $sql)) {

    // Redirect to login page
    header("Location:Login.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Close MySQL connection
mysqli_close($conn);
?>


<!doctype html>
<html lang="en">

<head>
    <title>Robot_34</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="Signup.css">
</head>

<body>
    <header>
        <div class="header">
            <h2 class="page-header">Sign-in</h2>
        </div>
    </header>
    <form action="Signup.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
      
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
      
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
      
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required><br>
      
        <input type="submit" value="Sign In">
      </form>
      
  

</html>