<?php
// Database connection
// Establish the database connection
include "admin/includes/connection.php";
// Add new field logic
if (isset($_POST['add_field'])) {
    $tableName = $_POST['table_name'];
    $newFieldName = $_POST['new_field_name'];
    $newFieldType = $_POST['new_field_type'];

    $sql = "ALTER TABLE `$tableName` ADD `$newFieldName` $newFieldType";

    if ($connection->query($sql) === TRUE) {
        echo "<div class='success'>Field added successfully.</div>";
    } else {
        echo "<div class='error'>Error adding field: " . $connection->error . "</div>";
    }
}


// Alter table field logic
if (isset($_POST['alter_table'])) {
    $tableName = $_POST['table_name'];
    $fieldName = $_POST['field_name'];
    $fieldType = $_POST['field_type'];

    $sql = "ALTER TABLE `$tableName` MODIFY `$fieldName` $fieldType";

    if ($connection->query($sql) === TRUE) {
        echo "<div class='success'>Field altered successfully.</div>";
    } else {
        echo "<div class='error'>Error altering field: " . $connection->error . "</div>";
    }
}

// Download table as .sql logic
if (isset($_POST['download_sql'])) {
    $tableName = $_POST['table_name'];
    $result = $connection->query("SHOW CREATE TABLE `$tableName`");

    if ($result) {
        $row = $result->fetch_assoc();
        $createTableSQL = $row['Create Table'];

        header('Content-Type: application/sql');
        header("Content-Disposition: attachment; filename=$tableName.sql");

        $output = fopen('php://output', 'w');
        fwrite($output, "$createTableSQL;

");

        $dataResult = $connection->query("SELECT * FROM `$tableName`");
        while ($row = $dataResult->fetch_assoc()) {
            $values = array_map(function ($value) use ($connection) {
                return "'" . $connection->real_escape_string($value) . "'";
            }, $row);

            $sql = "INSERT INTO `$tableName` VALUES (" . implode(", ", $values) . ");\n";
            fwrite($output, $sql);
        }

        fclose($output);
        exit();
    } else {
        echo "<div class='error'>Error fetching table: " . $connection->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>DB Utility Tool</title>
       <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }

        h2 {
            color: rgb(122, 48, 111);
            font-size: smaller;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: rgb(137, 58, 144);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: rgb(133, 43, 131);
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-4">
            <h2>Add New Field to Table</h2>
            <form method="post">
                Table Name: <input type="text" name="table_name" required><br>
                New Field Name: <input type="text" name="new_field_name" required><br>
                New Field Type: <input type="text" name="new_field_type" placeholder="e.g., VARCHAR(255), INT, etc." required><br>
                <input type="submit" name="add_field" value="Add Field">
            </form>
        </div>
        <div class="col-md-4">
            <h2>Alter Table Field</h2>
            <form method="post">
                Table Name: <input type="text" name="table_name" required><br>
                Field Name: <input type="text" name="field_name" required><br>
                New Field Type: <input type="text" name="field_type" placeholder="e.g., VARCHAR(255), INT, etc." required><br>
                <input type="submit" name="alter_table" value="Alter Field">
            </form>
        </div>
        <div class="col-md-4">
            <h2>Download Table as SQL</h2>
            <form method="post">
                Table Name: <input type="text" name="table_name" required><br>
                <input type="submit" name="download_sql" value="Download SQL">
            </form>
        </div>

    </div>





</body>

</html>