<?php
session_start();
include "db.php";

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];
    if(empty($title))
{
    die("Title Required");
}

    $stmt = mysqli_prepare(
    $conn,
    "INSERT INTO posts(title,content)
     VALUES(?,?)"
);

mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $title,
    $content
);

if(mysqli_stmt_execute($stmt))
{
    echo "Post Added Successfully!";
}
else
{
    echo mysqli_error($conn);
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-4" style="max-width:700px;">

<h2 class="mb-4">Add New Post</h2>

<form method="POST">

<div class="mb-3">
<label>Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label>Content</label>
<textarea name="content" class="form-control" rows="5" required></textarea>
</div>

<button type="submit" name="submit" class="btn btn-success">
Add Post
</button>

<a href="dashboard.php" class="btn btn-secondary">
Back to Dashboard
</a>

</form>

</div>

</body>
</html>