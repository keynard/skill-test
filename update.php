<?php

require_once "config.php";

$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    // Validate name
    $name = trim($_POST["name"]);
    if (!$name) {
        $name_err = "Please enter a name.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $name_err = "Please enter a valid name.";
    }

    // Validate address
    $address = trim($_POST["address"]);
    if (!$address) {
        $address_err = "Please enter an address.";
    }

    // Validate salary
    $salary = trim($_POST["salary"]);
    if (!$salary) {
        $salary_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($salary)) {
        $salary_err = "Please enter a positive integer value.";
    }

    // Update if no errors
    if (!$name_err && !$address_err && !$salary_err) {
        $stmt = mysqli_prepare($conn, "UPDATE employees SET name=?, address=?, salary=? WHERE id=?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $name, $address, $salary, $id);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
} else if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = mysqli_prepare($conn, "SELECT * FROM employees WHERE id=?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $name = $row["name"];
            $address = $row["address"];
            $salary = $row["salary"];
        } else {
            header("Location: error.php");
            exit();
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
} else {
    header("Location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <h2 class="mt-5">Update Record</h2>
        <p>Please edit the input values and submit to update the employee record.</p>
        <form action="" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="<?= $name_err ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($name) ?>">
                <span class="invalid-feedback"><?= $name_err ?></span>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="<?= $address_err ? 'is-invalid' : '' ?>"><?= htmlspecialchars($address) ?></textarea>
                <span class="invalid-feedback"><?= $address_err ?></span>
            </div>
            <div class="form-group">
                <label>Salary</label>
                <input type="text" name="salary" class="<?= $salary_err ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($salary) ?>">
                <span class="invalid-feedback"><?= $salary_err ?></span>
            </div>
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>"/>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>