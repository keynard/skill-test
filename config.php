<?php

// Database config
$conn = mysqli_connect('localhost', 'root', '', 'skill_test');

// Check connection
if (!$conn) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>