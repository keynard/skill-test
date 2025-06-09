<?php

require_once "config.php";

// Initialize variables
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Insert if no errors
    if (!$name_err && !$address_err && !$salary_err) {
        $stmt = mysqli_prepare($conn, "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $address, $salary);
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <h2 class="mt-5">Create Record</h2>
        <p>Please fill this form and submit to add employee record to the database.</p>
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
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>