<?php
session_start();

// Assuming you have already established the database connection here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the user's credentials (you'll need to adapt this part)
    $sql = "SELECT id FROM register WHERE uname = '$username' AND pass = '$password'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];
        header("Location: dashboard.php");
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Your HTML head content ... -->
</head>
<body>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php if(isset($login_error)) { echo $login_error; } ?>
</body>
</html>
