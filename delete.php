<?php

error_reporting(0);
$search_value = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_db";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Start Delete query---------------------------------------------------------
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo $id;
        $delete_patient = "DELETE FROM patient_tb WHERE p_id = $id";

        mysqli_query($mysqli, $delete_patient);
        // End delete query-------------------------------------------------------



        // After delete return to the view.php page------------------------------------------------
        header('location: view.php');

    }
}
?>