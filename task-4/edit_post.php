<?php
session_start();
include "db.php";

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM posts WHERE id=?"
);

mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = mysqli_prepare(
    $conn,
    "UPDATE posts
     SET title=?,content=?
     WHERE id=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "ssi",
    $title,
    $content,
    $id
);

mysqli_stmt_execute($stmt);

    header("Location: view_posts.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4" style="max-width:700px;">

<h2 class="mb-4">Edit Post</h2>

<form method="POST">

<div class="mb-3">
<label>Title</label>
<input type="text"
       name="title"
       value="<?php echo $post['title']; ?>"
       class="form-control"
       required>
</div>

<div class="mb-3">
<label>Content</label>
<textarea name="content"
          class="form-control"
          rows="5"
          required><?php echo $post['content']; ?></textarea>
</div>

<button type="submit" name="update" class="btn btn-primary">
Update Post
</button>

<a href="view_posts.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</body>
</html>