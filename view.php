<?php
error_reporting(0);
$search_value = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$mysqli = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $search_value = $_POST["search"];
    if (isset($search_value) && !empty($search_value)) {
        $sql = "SELECT		
                    patient_tb.p_id,
                    patient_tb.p_name,
                    patient_tb.p_address,
                    patient_tb.p_contact,
                    doctor_tb.doctor_name,
                    bill_tb.total_bill,
                    bill_tb.total_paid,
                    bill_tb.total_due,
                    bill_tb.payment_status,
                    pathology.test_name,
                    pathology.cost
        FROM patient_tb 
                  LEFT JOIN doctor_tb ON doctor_tb.doctor_id=patient_tb.doctor_id 
                  LEFT JOIN bill_tb ON bill_tb.patient_id=patient_tb.p_id
                  LEFT JOIN pathology ON pathology.patient_id=patient_tb.p_id
                  WHERE patient_tb.p_name LIKE '$search_value%'
                  OR doctor_tb.doctor_name LIKE '$search_value%'
                  OR pathology.test_name LIKE '$search_value%'
                  OR bill_tb.payment_status LIKE '$search_value%'";

        $result = $conn->query($sql);


        $conn->close();
    } else {
        $search_value = "";
        $sql = "SELECT		
                    patient_tb.p_id,
                    patient_tb.p_name,
                    patient_tb.p_address,
                    patient_tb.p_contact,
                    doctor_tb.doctor_name,
                    bill_tb.total_bill,
                    bill_tb.total_paid,
                    bill_tb.total_due,
                    bill_tb.payment_status,
                    pathology.test_name,
                    pathology.cost
        FROM patient_tb 
                  LEFT JOIN doctor_tb ON doctor_tb.doctor_id=patient_tb.doctor_id 
                  LEFT JOIN bill_tb ON bill_tb.patient_id=patient_tb.p_id
                  LEFT JOIN pathology ON pathology.patient_id=patient_tb.p_id";

        $result = $conn->query($sql);

        $r = $result->num_rows;
        $conn->close();
    }
}
?>

<!doctype html>
<html>
<head>
    <title>HMS | View</title>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body class="body_design_view">
<div>
    <h1 style="color: white;" class="header_text">Patient Detail's</h1>
</div>
<form id="form_search" action="" method="post">
    <div class="search">
        <input type="text" class="searchTerm" name="search" placeholder="What are you looking for?">
        <button type="submit" class="searchButton">
            <i class="fa fa-search"></i>
        </button>
        <button type="submit" class="reloadButton"><i class="fa fa-refresh"></i></button>
    </div>
</form>
<div class="tbl_div">
    <table class="table" border="1">
        <thead>
        <tr>
            <th>SL.</th>
            <th style="width: 500px;">Patient Name</th>
            <th>Doctor Name</th>
            <th>Test Name</th>
            <th>Total Bill</th>
            <th>Total Paid</th>
            <th>Total Due</th>
            <th>Payment Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody class="tbl_body">
        <?php
        $i = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $i++;
                echo "<tr style='border: 1px solid black; color: white'>
                    <td>" . $i . "</td>
                    <td style='background-color: mediumvioletred'>" . $row["p_name"] . "</td>
                    <td>" . $row["doctor_name"] . "</td>
                    <td>" . $row["test_name"] . "</td>
                    <td>" . $row["total_bill"] . "</td>
                    <td>" . $row["total_paid"] . "</td>
                    <td>" . $row["total_due"] . "</td>
                    <td>" . $row["payment_status"] . "</td>
                    <td>
                        <a href='edit.php?id=" . $row["p_id"] . "'>
                            <button style='background-color: darkorange; color: white; width: 80px; height: 30px; border-radius: 5px; border: 1px solid darkorange' type='button'>
                                <i class='fa fa-edit'></i>
                                    Edit
                            </button>
                        </a>
                        <a href='delete.php?id=" . $row["p_id"] . "'>
                            <button style='background-color:red;width: 80px; color: white; height: 30px; border-radius: 5px; border: 1px solid red' type='submit' name='delete'>
                                <i class='fa fa-trash'></i>
                                    Delete
                            </button>
                            </a>
                    </td>";
                "</tr>";
            }
        } else {
            echo "0 results";
        }
        ?>
        </tbody>
    </table>
</div>
<a href="index.php">
    <input class="button_back" type="button" value="Back To Home Page"/>
</a>
<div style="color: white;text-align: center; margin-top: 150px">
    <p>Developed By Zinia Nur , Tajnova Yasin Esha and Naima Akter Nadia</p>
</div>
</body>
</html>