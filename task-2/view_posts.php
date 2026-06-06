<?php
session_start();
include "db.php";

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Posts</title>
</head>
<body>

<h2>All Posts</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Content</th>
    <th>Date</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['content']; ?></td>
    <td><?php echo $row['created_at']; ?></td>

    <td>
        <a href="edit_post.php?id=<?php echo $row['id']; ?>">
            Edit
        </a>
    </td>

    <td>
        <a href="delete_post.php?id=<?php echo $row['id']; ?>">
            Delete
        </a>
    </td>
</tr>
<?php
}
?>

</table>

<br>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>