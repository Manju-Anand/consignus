<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'thiruvallapromos_consignus_software');
define('DB_PASS', 'L^}+Sj#DC1S^');
define('DB_NAME', 'thiruvallapromos_consignus_software');

try {

    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->set_charset('utf8mb4');

} catch (Exception $e) {
    error_log("DB Connection Error: " . $e->getMessage());
    exit('Database connection failed.');
}



// Fetch the list of tables
$query = "SHOW TABLES";
$result = mysqli_query($connection, $query);

if ($result) {
    echo "<h1>Database Records</h1>";

    while ($row = mysqli_fetch_array($result)) {
        $table = $row[0];
        echo "<h2>Table: $table</h2>";

        // Fetch all records from the table
        $tableQuery = "SELECT * FROM `$table`";
        $tableResult = mysqli_query($connection, $tableQuery);

        if ($tableResult && mysqli_num_rows($tableResult) > 0) {
            echo "<table border='1' cellpadding='10' cellspacing='0'>";
            echo "<thead>";

            // Display column headers
            $fieldInfo = mysqli_fetch_fields($tableResult);
            echo "<tr>";
            foreach ($fieldInfo as $field) {
                echo "<th>" . htmlspecialchars($field->name) . "</th>";
            }
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Display table rows
            while ($rowData = mysqli_fetch_assoc($tableResult)) {
                echo "<tr>";
                foreach ($rowData as $cell) {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No records found in the table <b>$table</b>.</p>";
        }
    }
} else {
    echo "<p>Failed to retrieve tables: " . mysqli_error($connection) . "</p>";
}

// Close the connection
mysqli_close($connection);
?>
