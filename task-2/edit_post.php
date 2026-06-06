<?php
session_start();
include "db.php";

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE id=$id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    $update = "UPDATE posts
               SET title='$title',
                   content='$content'
               WHERE id=$id";

    mysqli_query($conn, $update);

    header("Location: view_posts.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>

<h2>Edit Post</h2>

<form method="POST">

Title:
<input type="text"
       name="title"
       value="<?php echo $post['title']; ?>"
       required>

<br><br>

Content:
<textarea name="content" required><?php echo $post['content']; ?></textarea>

<br><br>

<button type="submit" name="update">
Update Post
</button>

</form>

</body>
</html>