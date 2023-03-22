<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the email is valid
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-danger" role="alert">Invalid email address!</div>';
            exit();
        }

        // Generate a new password
        $new_password = substr(md5(uniqid(rand(), true)), 0, 8);

        // Update the password in the database
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "form";
        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            // Send the new password to the user's email address
            $to = $email;
            $subject = "New Password";
            $message = "Your new password is: $new_password";
            $headers = "From: webmaster@example.com";
            mail($to, $subject, $message, $headers);

            header("Location:Login.php");
            exit();
            // Display a success message
            echo '<div class="alert alert-success" role="alert">A new password has been sent to your email address.</div>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>
<!doctype html>
<html lang="en">

<head>
    <title>Forgot Password</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport">
    <link rel="stylesheet" href="ForgotPassword.css">
</head>

<body>
    <header>
        <div class="header">
            <h2 class="page-header">Forgot Password</h2>
        </div>
    </header>
    <form action="forgotpass.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>
