<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["upload"])) {
        $folder = trim($_POST["folder"]);
        $files = $_FILES["files"];

        if (!empty($folder) && !preg_match('/^[a-zA-Z0-9_\-\/]+$/', $folder)) {
            die("Invalid folder name.");
        }

        $folder = str_replace("..", "", $folder);
        $targetDir = empty($folder) ? __DIR__ : __DIR__ . "/" . $folder;

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $totalFiles = count($files['name']);
        for ($i = 0; $i < $totalFiles; $i++) {
            if ($files['error'][$i] == 0) {
                $targetFile = $targetDir . "/" . basename($files['name'][$i]);
                if (move_uploaded_file($files['tmp_name'][$i], $targetFile)) {
                    echo "File " . htmlspecialchars($files['name'][$i]) . " uploaded successfully!<br>";
                } else {
                    echo "Failed to upload file: " . htmlspecialchars($files['name'][$i]) . "<br>";
                }
            }
        }
    }

    if (isset($_POST["download"])) {
        $downloadFolder = trim($_POST["downloadFolder"]);
        $downloadFile = trim($_POST["downloadFile"]);
        $filePath = __DIR__ . "/" . $downloadFolder . "/" . $downloadFile;

        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            readfile($filePath);
            exit();
        } else {
            echo "File not found!";
        }
    }

    if (isset($_POST["delete"])) {
        $deleteFolder = trim($_POST["deleteFolder"]);
        $deleteFile = trim($_POST["deleteFile"]);
        $filePath = __DIR__ . "/" . $deleteFolder . "/" . $deleteFile;

        if (file_exists($filePath)) {
            unlink($filePath);
            echo "File " . htmlspecialchars($deleteFile) . " deleted successfully!<br>";
        } else {
            echo "File not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f9;
            text-align: center;
        }

        form {
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        input,
        button {
            margin-bottom: 15px;
            padding: 10px;
            width: 90%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        h2 {
            color: #333;
        }
    </style>
</head>

<body>
    <h2>Nested Folder Upload [ use / for subfolders ]</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="folder">Folder Name:</label>
        <input type="text" name="folder" id="folder">
        <br>
        <label for="files">Select Files:</label>
        <input type="file" name="files[]" id="files" multiple>
        <br>
        <button type="submit" name="upload">Upload</button>
    </form>

    <h2>Download File</h2>
    <form action="" method="post">
        <label for="downloadFolder">Folder Name:</label>
        <input type="text" name="downloadFolder" id="downloadFolder">
        <br>
        <label for="downloadFile">File Name:</label>
        <input type="text" name="downloadFile" id="downloadFile" required>
        <br>
        <button type="submit" name="download">Download</button>
    </form>

    <h2>Delete File</h2>
    <form action="" method="post">
        <label for="deleteFolder">Folder Name:</label>
        <input type="text" name="deleteFolder" id="deleteFolder">
        <br>
        <label for="deleteFile">File Name:</label>
        <input type="text" name="deleteFile" id="deleteFile" required>
        <br>
        <button type="submit" name="delete">Delete</button>
    </form>
</body>

</html>