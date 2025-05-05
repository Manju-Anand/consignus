<?php
require_once 'vendor/autoload.php';

use Mpdf\Mpdf;

try {
    $mpdf = new Mpdf();
    $mpdf->WriteHTML('<h1>Test PDF</h1>');
    $mpdf->Output();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
<h1>fsdfsf</h1>