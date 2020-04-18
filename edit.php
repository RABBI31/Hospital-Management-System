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
    // Start query to Show patient details--------------------------------------------------------------
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $get_patient_details = "SELECT		
                    patient_tb.p_id,
                    patient_tb.p_name,
                    patient_tb.p_address,
                    patient_tb.p_contact,
                    doctor_tb.doctor_id,
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
                  WHERE patient_tb.p_id = $id";

        $get_doctor_lists = "SELECT * FROM `doctor_tb`";
        $get_test_lists = "SELECT * FROM `pathology`";

        $doctor_lists = $conn->query($get_doctor_lists);
        $test_lists = $conn->query($get_test_lists);
        $patient_details = $conn->query($get_patient_details);
        if ($patient_details->num_rows > 0) {
            // output data of each row
            while ($row = $patient_details->fetch_assoc()) {
                $p_id = $row["p_id"];
                $p_name = $row["p_name"];
                $doctor_id = $row["doctor_id"];
                $doctor_name = $row["doctor_name"];
                $test_name = $row["test_name"];
                $total_bill = $row["total_bill"];
                $total_paid = $row["total_paid"];
                $total_due = $row["total_due"];
                $payment_status = $row["payment_status"];
            }
        }
        $conn->close();
    }
    // End query to Show patient details--------------------------------------------------------------

    // Start Updating patient details------------------------------------------------------------------
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $p_name = $_POST['patient_name'];
        $d_id = $_POST['doctor_name'];
        $t_name = $_POST['test_name'];
        $b_bill = $_POST['total_bill'];
        $b_paid = $_POST['total_paid'];
        $b_due = $_POST['total_due'];
        $b_payment_status = $_POST['payment_status'];

        $update_patient_tb = "UPDATE
                                patient_tb
                                  SET
                                 p_name = '$p_name',
                                 doctor_id = '$d_id'
                                WHERE p_id = $id";
        $update_test_tb = "UPDATE 
                                pathology
                                  SET
                                 test_name = '$t_name'
                                WHERE patient_id = $id";
        $update_bill_tb = "UPDATE
                                bill_tb
                                  SET
                                 total_bill = '$b_bill',
                                 total_paid = '$b_paid',
                                 total_due = '$b_due',
                                 payment_status = '$b_payment_status'
                                WHERE patient_id = $id";

        mysqli_query($mysqli,$update_patient_tb);
        mysqli_query($mysqli,$update_test_tb);
        mysqli_query($mysqli,$update_bill_tb);
        // End Update Query -----------------------------------------------

        // After Update return to the view.php page-------------------------
        header('location: view.php');
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
    <h1 style="color: white;" class="header_text">Edit Patient Detail's</h1>
</div>
<div style="text-align: center; background-color: white; !important;" class="tbl_div">

    <form action="" method="post">
        <table class="edit_table">
            <tbody>
            <tr>
                <th>
                    <label>Patient Name : </label>
                </th>
                <td>
                    <input class="edit_input" type="text" name="patient_name" value="<?php echo $p_name; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label>Doctor Name : </label>
                </th>
                <td>
                    <select class="edit_input" name="doctor_name">
                        <option>Select A Doctor</option>
                        <?php
                        if ($doctor_lists->num_rows > 0) {
                            // output data of each row
                            while ($pd = $doctor_lists->fetch_assoc()) {
                                echo "<option value='" . $pd['doctor_id'] . "'" . (($doctor_id == $pd['doctor_id']) ? 'selected="selected"' : "") . ">" . $pd['doctor_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>
                    <label>Test Name : </label>
                </th>
                <td>
                    <input type="text" class="edit_input" name="test_name" value="<?php echo $test_name; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label>Total Bill : </label>
                </th>
                <td>
                    <input class="edit_input" type="text" name="total_bill" value="<?php echo $total_bill; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label>Total Paid : </label>
                </th>
                <td>
                    <input class="edit_input" type="text" name="total_paid" value="<?php echo $total_paid; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label>Total Due : </label>
                </th>
                <td>
                    <input class="edit_input" type="text" name="total_due" value="<?php echo $total_due; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label>Payment Status : </label>
                </th>
                <td>
                    <input class="edit_input" type="text" name="payment_status" value="<?php echo $payment_status; ?>">
                    <input type="hidden" name="id" value="<?php echo $p_id; ?>">
                </td>
            </tr>
            <tr>
                <th>

                </th>
                <td>
                    <input style="background-color: limegreen; width: 150px; height: 30px;" name="update" type="submit"
                           value="Update">
                </td>
            </tr>
            </tbody>
        </table>
    </form>


</div>
<a href="view.php">
    <input class="button_back" type="button" value="Back"/>
</a>
<div style="color: white;text-align: center; margin-top: 150px">
    <p>Developed By Zinia Nur , Tajnova Yasin Esha and Naima Akter Nadia</p>
</div>
</body>
</html>