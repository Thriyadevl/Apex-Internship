<?php
include "db.php";

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $username = trim($username);

if(strlen($username) < 3)
{
    die("Username must be at least 3 characters");
}
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $role = "user";

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO users(username,password,role)
     VALUES(?,?,?)"
);

mysqli_stmt_bind_param(
    $stmt,
    "sss",
    $username,
    $password,
    $role
);

if(mysqli_stmt_execute($stmt))
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