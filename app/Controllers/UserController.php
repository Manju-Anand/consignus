<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class UserController extends Controller
{
    public function showAllTables()
    {
        $db = Database::connect();

        // Fetch all tables
        $tables = $db->listTables();
        $data = [];

        foreach ($tables as $table) {
            // Fetch all rows
            $query = $db->query("SELECT * FROM `$table`");
            $results = $query->getResultArray();

            // Get field names
            $fields = $query->getFieldNames();

            $data[] = [
                'table'  => $table,
                'fields' => $fields,
                'rows'   => $results
            ];
        }

        return view('staff/all_views', ['tablesData' => $data]);
    }
    // ***************************************** alterdb*******************
    public function index()
    {
        return view('staff/all_tools');
    }

    public function process()
    {
        $db = Database::connect();

        $response = '';

        if ($this->request->getPost('add_field')) {
            $tableName = $this->request->getPost('table_name');
            $newFieldName = $this->request->getPost('new_field_name');
            $newFieldType = $this->request->getPost('new_field_type');

            $sql = "ALTER TABLE `$tableName` ADD `$newFieldName` $newFieldType";

            if ($db->query($sql)) {
                $response = '<div class="success">Field added successfully.</div>';
            } else {
                $response = '<div class="error">Error adding field: ' . $db->error()['message'] . '</div>';
            }
        }

        if ($this->request->getPost('alter_table')) {
            $tableName = $this->request->getPost('table_name');
            $fieldName = $this->request->getPost('field_name');
            $fieldType = $this->request->getPost('field_type');

            $sql = "ALTER TABLE `$tableName` MODIFY `$fieldName` $fieldType";

            if ($db->query($sql)) {
                $response = '<div class="success">Field altered successfully.</div>';
            } else {
                $response = '<div class="error">Error altering field: ' . $db->error()['message'] . '</div>';
            }
        }

        if ($this->request->getPost('download_sql')) {
            $tableName = $this->request->getPost('table_name');
            $result = $db->query("SHOW CREATE TABLE `$tableName`");
            $row = $result->getRowArray();

            $createTableSQL = $row['Create Table'];

            header('Content-Type: application/sql');
            header("Content-Disposition: attachment; filename=$tableName.sql");

            echo "$createTableSQL;\n\n";

            $dataResult = $db->query("SELECT * FROM `$tableName`");
            foreach ($dataResult->getResultArray() as $dataRow) {
                $values = array_map(function ($value) use ($db) {
                    return "'" . addslashes($value) . "'";
                }, $dataRow);

                $sql = "INSERT INTO `$tableName` VALUES (" . implode(", ", $values) . ");\n";
                echo $sql;
            }
            exit();
        }

        return view('staff/all_tools', ['response' => $response]);
    }

    // ***************************************** file ***********************

    public function fileindex()
    {
        return view('staff/fl_views');
    }

    public function upload()
    {
        $folder = trim($this->request->getPost('folder'));
        $uploadedFiles = $this->request->getFiles();

        if (empty($folder)) {
            return redirect()->back()->with('message', 'Folder name is required.');
        }

        // Security check: prevent path traversal
        if (str_contains($folder, '..') || !preg_match('/^[a-zA-Z0-9_\-\/]+$/', $folder)) {
            return redirect()->back()->with('message', 'Invalid folder name.');
        }

        // Resolve full path relative to project root
        // $projectRoot = realpath(FCPATH . '../');
        $projectRoot = realpath(ROOTPATH); // Correct base

        $targetDir = $projectRoot . DIRECTORY_SEPARATOR . $folder;

        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                return redirect()->back()->with('message', 'Failed to create directory: ' . $folder);
            }
        }

        $results = [];

        // Support multiple files
        foreach ($uploadedFiles['files'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $originalName = $file->getClientName();
                $tempPath = $file->getTempName();
                $destinationPath = $targetDir . DIRECTORY_SEPARATOR . $originalName;

                if (move_uploaded_file($tempPath, $destinationPath)) {
                    $results[] = "Uploaded: $originalName → $folder -> $destinationPath";
                } else {
                    $results[] = "❌ Failed to upload: $originalName";
                }
            }
        }

        return redirect()->back()->with('message', implode('<br>', $results));
    }




    public function download()
    {
        $folder = trim($this->request->getPost('downloadFolder'));
        $file = trim($this->request->getPost('downloadFile'));

        // $path = WRITEPATH . 'uploads/' . $folder . '/' . $file;
        $projectRoot = realpath(ROOTPATH); // Correct base

        $path = $projectRoot . DIRECTORY_SEPARATOR . $folder . '/' . $file;

        if (file_exists($path)) {
            return $this->response->download($path, null);
        }

        return redirect()->back()->with('message', 'File not found!');
    }

    public function delete()
    {
        $folder = trim($this->request->getPost('deleteFolder'));
        $file = trim($this->request->getPost('deleteFile'));
        // $path = WRITEPATH . 'uploads/' . $folder . '/' . $file;
        $projectRoot = realpath(ROOTPATH); // Correct base

        $path = $projectRoot . DIRECTORY_SEPARATOR . $folder . '/' . $file;

        if (file_exists($path)) {
            unlink($path);
            return redirect()->back()->with('message', 'File deleted successfully!');
        }

        return redirect()->back()->with('message', 'File not found!');
    }
    // **************************** truncate *****************

    public function truncateTables()
    {
        $db = \Config\Database::connect();
        log_message('debug', 'Request method: ' . $this->request->getMethod());
        if ($this->request->getMethod() === 'POST') {

            $tables = $this->request->getPost('tables');
            if (!empty($tables)) {
                foreach ($tables as $table) {
                    $db->query("TRUNCATE TABLE `" . $db->escapeString($table) . "`");
                }
                return redirect()->back()->with('message', 'Selected tables truncated successfully!');
            } else {
                return redirect()->back()->with('error', 'No tables selected.');
            }
        } else {

            // Show form
            $allTables = $db->listTables();
            return view('staff/truncate_staff', ['tables' => $allTables]);
        }
    }
}
