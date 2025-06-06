<?php

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require_once "config.php";
    $id = trim($_GET["id"]);
    $stmt = mysqli_prepare($conn, "SELECT * FROM employees WHERE id = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $name = $row["name"];
            $address = $row["address"];
            $salary = $row["salary"];
        } else {
            header("location: error.php");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
    mysqli_close($conn);
} else {
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{width:600px;margin:0 auto;}
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?= htmlspecialchars($name) ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p><b><?= htmlspecialchars($address) ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <p><b><?= htmlspecialchars($salary) ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>