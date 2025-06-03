<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Management</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f4f4f9; text-align: center; }
        form { margin: 20px auto; padding: 20px; background: #fff; border-radius: 10px; max-width: 500px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, button { margin-bottom: 15px; padding: 10px; width: 90%; border-radius: 5px; border: 1px solid #ccc; }
        button { background-color: #007BFF; color: #fff; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .message { color: green; margin: 10px 0; }
    </style>
</head>
<body>
    <?php if(session()->getFlashdata('message')): ?>
        <div class="message"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <h2>Nested Folder Upload [ use / for subfolders ]</h2>
    <form action="<?= site_url('data-staff-manager/upload') ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="folder" placeholder="Folder Name">
        <input type="file" name="files[]" multiple>
        <button type="submit">Upload</button>
    </form>
    <?php if(session()->getFlashdata('message')): ?>
    <div><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>

    <h2>Download File</h2>
    <form action="<?= site_url('data-staff-manager/download') ?>" method="post">
        <input type="text" name="downloadFolder" placeholder="Folder Name">
        <input type="text" name="downloadFile" placeholder="File Name" required>
        <button type="submit">Download</button>
    </form>

    <h2>Delete File</h2>
    <form action="<?= site_url('data-staff-manager/delete') ?>" method="post">
        <input type="text" name="deleteFolder" placeholder="Folder Name">
        <input type="text" name="deleteFile" placeholder="File Name" required>
        <button type="submit">Delete</button>
    </form>
</body>
</html>
