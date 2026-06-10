<?php
session_start();
include "db.php";

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM posts
        WHERE title LIKE '%$search%'
        OR content LIKE '%$search%'
        LIMIT $start, $limit";

$result = mysqli_query($conn, $sql);

$count_sql = "SELECT COUNT(*) AS total
              FROM posts
              WHERE title LIKE '%$search%'
              OR content LIKE '%$search%'";

$count_result = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_result);

$total_pages = ceil($count_row['total'] / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Posts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2 class="mb-3">All Posts</h2>

    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search Posts"
                       value="<?php echo $search; ?>">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">
                    Search
                </button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
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
                <a class="btn btn-success btn-sm"
                   href="edit_post.php?id=<?php echo $row['id']; ?>">
                    Edit
                </a>
            </td>

            <td>
                <a class="btn btn-danger btn-sm"
                   href="delete_post.php?id=<?php echo $row['id']; ?>">
                    Delete
                </a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <div class="mb-3">
        <?php
        for($i = 1; $i <= $total_pages; $i++)
        {
            echo "<a class='btn btn-outline-primary me-1' href='view_posts.php?page=$i&search=$search'>$i</a>";
        }
        ?>
    </div>

    <a href="dashboard.php" class="btn btn-secondary">
        Back to Dashboard
    </a>

</div>

</body>
</html>
