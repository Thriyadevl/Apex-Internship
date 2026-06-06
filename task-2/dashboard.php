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
</head>
<body>

<h2>Welcome <?php echo $_SESSION['username']; ?></h2>

<a href="add_post.php">Add Post</a>
<br><br>

<a href="view_posts.php">View Posts</a>
<br><br>

<a href="logout.php">Logout</a>

</body>
</html>