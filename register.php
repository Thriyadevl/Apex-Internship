<?php
include "db.php";

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(username, password)
            VALUES('$username', '$password')";

    if(mysqli_query($conn, $sql))
    {
        echo "Registration Successful!";
    }
    else
    {
        echo "Error!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width:500px;">

<h2 class="mb-4">User Registration</h2>

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="register" class="btn btn-success">
Register
</button>

<a href="login.php" class="btn btn-primary">
Login
</a>

</form>

</div>
</body>
</html>