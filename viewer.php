<?php
// $hostname = "localhost";
// $username = "root";
// $password = "";
// $database = "neuaietutor";

// $conn = new mysqli($hostname, $username, $password, $database);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
include('api/conn.php');

// Function to fetch data from the selected table
function fetchTableData($tableName, $conn) {
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return [];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedTable = $_POST["table"];

    // Fetch data from the selected table
    $tableData = fetchTableData($selectedTable, $conn);
}

// Export to Excel function
function exportToExcel($data, $tableName) {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $tableName . '.xlsx"');

    require_once 'PHPExcel/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');

    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $writer->save('php://output');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Table Export to Excel</title>
</head>
<body>
    <h1>Select a Table to Export</h1>
    <form method="post">
        <label for="table">Select Table:</label>
        <select name="table">
            <?php
            $tableListSql = "SHOW TABLES";
            $tableListResult = $conn->query($tableListSql);
            while ($tableRow = $tableListResult->fetch_row()) {
                echo '<option value="' . $tableRow[0] . '">' . $tableRow[0] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Export to Excel">
    </form>

    <?php
    if (isset($tableData) && !empty($tableData)) {
        echo '<h2>Table Data:</h2>';
        echo '<table border="1">';
        // Output table header
        echo '<tr>';
        foreach ($tableData[0] as $key => $value) {
            echo '<th>' . $key . '</th>';
        }
        echo '</tr>';
        // Output table data
        foreach ($tableData as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        // Export to Excel button
        echo '<form method="post">';
        echo '<input type="hidden" name="export" value="1">';
        echo '<input type="hidden" name="table" value="' . $selectedTable . '">';
        echo '<input type="submit" value="Export to Excel">';
        echo '</form>';
    }
    ?>

</body>
</html>
