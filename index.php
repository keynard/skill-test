
<?php
require_once "config.php";

// Handle delete action
if (isset($_GET["id"], $_GET["action"]) && $_GET["action"] === "delete") {
    $id = (int) $_GET["id"];
    $stmt = mysqli_prepare($conn, "DELETE FROM employees WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard</title>
    
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="float-left">Employee Details</h2>
            <a href="create.php" class="btn btn-success float-right">Add New Employee</a>
        </div>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM employees");
        if ($result && mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th><th>Name</th><th>Address</th><th>Salary</th><th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['salary'] ?></td>
                        <td>
                            <a href="read.php?id=<?= $row['id'] ?>" class="mr-3" title="View Record"><span class="text-primary">View</span></a>
                            <a href="update.php?id=<?= $row['id'] ?>" class="mr-3" title="Update Record"><span class="text-info">Update</span></a>
                            <a href="index.php?id=<?= $row['id'] ?>&action=delete" title="Delete Record"><span class="text-danger">Delete</span></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php
            mysqli_free_result($result);
        else:
            echo '<div class="alert-danger"><em>No records were found.</em></div>';
        endif;
        mysqli_close($conn);
        ?>
    </div>
</div>
</body>
</html>