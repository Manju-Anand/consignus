<!DOCTYPE html>
<html>
<head>
    <title>Truncate Tables</title>
    <style>
        body { font-family: Arial; background: #f0f2f5; padding: 30px; }
        form { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; max-width: 600px; margin: auto; }
        h2 { text-align: center; }
        label { display: block; margin-bottom: 8px; }
        input[type="submit"] { padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; }
        input[type="submit"]:hover { background: #c82333; }
    </style>
</head>
<body>

<?php if (session()->getFlashdata('message')): ?>
    <p style="color: green; text-align: center;"><?= session()->getFlashdata('message') ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red; text-align: center;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= site_url('data-staff-truncate') ?>"  onsubmit="return confirmDeletion();">
    <h2>Clear Data from Tables</h2>
    <?php foreach ($tables as $table): ?>
        <label><input type="checkbox" name="tables[]" value="<?= esc($table) ?>"> <?= esc($table) ?></label>
    <?php endforeach; ?>
    <br>
    <button type="submit">Truncate Selected Tables</button>
</form>

<script>
function confirmDeletion() {
    return confirm("Are you sure you want to DELETE ALL DATA from selected tables?");
}
</script>

</body>
</html>
