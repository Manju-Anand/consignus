<!DOCTYPE html>
<html>
<head>
    <title>Database Tables Viewer</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 40px; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
        th { background-color: #eee; }
        h2 { background-color: #f2f2f2; padding: 10px; }
    </style>
</head>
<body>
    <h1>All Database Tables</h1>

    <?php foreach ($tablesData as $table): ?>
        <h2>Table: <?= esc($table['table']) ?></h2>

        <?php if (!empty($table['rows'])): ?>
            <table>
                <thead>
                    <tr>
                        <?php foreach ($table['fields'] as $field): ?>
                            <th><?= esc($field) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($table['rows'] as $row): ?>
                        <tr>
                            <?php foreach ($table['fields'] as $field): ?>
                                <td><?= esc($row[$field]) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No records found in table <b><?= esc($table['table']) ?></b>.</p>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>
