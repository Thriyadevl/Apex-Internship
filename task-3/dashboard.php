<?php
session_start();

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card p-4">

        <h2 class="mb-4">
            Welcome, <?php echo $_SESSION['username']; ?>
        </h2>

        <div class="d-grid gap-3">

            <a href="add_post.php" class="btn btn-success">
                Add Post
            </a>

            <a href="view_posts.php" class="btn btn-primary">
                View Posts
            </a>

            <a href="logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>

</div>

</body>
</html>
