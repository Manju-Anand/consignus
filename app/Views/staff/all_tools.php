<!DOCTYPE html>
<html>
<head>
    <title>DB Utility Tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }
        h2 { color: rgb(122, 48, 111); font-size: smaller; }
        form {
            background-color: #fff; padding: 20px;
            border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            width: 100%; padding: 8px; margin: 8px 0;
            border: 1px solid #ccc; border-radius: 4px;
        }
        input[type="submit"] {
            background-color: rgb(137, 58, 144); color: #fff;
            border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: rgb(133, 43, 131);
        }
        .success { color: green; margin-top: 10px; }
        .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>
    <?= isset($response) ? $response : '' ?>

    <div class="row">
        <div class="col-md-4">
            <h2>Add New Field to Table</h2>
            <form method="post" action="<?= site_url('data-staff-db-tool') ?>">
                <input type="hidden" name="add_field" value="1">
                Table Name: <input type="text" name="table_name" required>
                New Field Name: <input type="text" name="new_field_name" required>
                New Field Type: <input type="text" name="new_field_type" placeholder="e.g., VARCHAR(255), INT, etc." required>
                <input type="submit" value="Add Field">
            </form>
        </div>
        <div class="col-md-4">
            <h2>Alter Table Field</h2>
            <form method="post" action="<?= site_url('data-staff-db-tool') ?>">
                <input type="hidden" name="alter_table" value="1">
                Table Name: <input type="text" name="table_name" required>
                Field Name: <input type="text" name="field_name" required>
                New Field Type: <input type="text" name="field_type" placeholder="e.g., VARCHAR(255), INT, etc." required>
                <input type="submit" value="Alter Field">
            </form>
        </div>
        <div class="col-md-4">
            <h2>Download Table as SQL</h2>
            <form method="post" action="<?= site_url('data-staff-db-tool') ?>">
                <input type="hidden" name="download_sql" value="1">
                Table Name: <input type="text" name="table_name" required>
                <input type="submit" value="Download SQL">
            </form>
        </div>
    </div>
</body>
</html>
