<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

use Mpdf\Mpdf;

class BillController extends Controller
{

// public $mmodel;
    public function generatePDF()
    {
        require_once ROOTPATH . 'vendor/autoload.php';

        try {
            $mpdf = new Mpdf(); // Initialize mPDF
            
            // Sample Bill/Invoice HTML Content
            $html = '
                <style>
                    body { font-family: Arial, sans-serif; }
                    .invoice-box { width: 100%; border: 1px solid #ddd; padding: 20px; }
                    .header { text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 10px; }
                    .details { width: 100%; border-collapse: collapse; }
                    .details th, .details td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    .total { font-size: 18px; font-weight: bold; text-align: right; margin-top: 10px; }
                </style>
                
                <div class="invoice-box">
                    <div class="header">Invoice</div>
                    <table class="details">
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>Product A</td>
                            <td>2</td>
                            <td>₹500</td>
                            <td>₹1000</td>
                        </tr>
                        <tr>
                            <td>Product B</td>
                            <td>1</td>
                            <td>₹300</td>
                            <td>₹300</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:right;"><b>Grand Total:</b></td>
                            <td><b>₹1300</b></td>
                        </tr>
                    </table>
                </div>
            ';

            $mpdf->WriteHTML($html);

            // Output PDF to Browser
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'attachment; filename="test1.pdf"')
                ->setBody($mpdf->Output('', 'S'));
        } catch (\Throwable $e) {
            return 'Error generating PDF: ' . $e->getMessage();
        }
    }

    public function downloadBill()
    {
        require_once ROOTPATH . 'vendor/autoload.php';

        // Initialize Dompdf
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new Dompdf($options);

        // Bill Data (You can fetch this from your database)
        $invoiceNumber = "INV-2025001";
        $invoiceDate = date("d M, Y");
        $customerName = "John Doe";
        $customerAddress = "123 Main Street, New York, NY 10001";
        $customerPhone = "+1 234-567-890";
        $customerEmail = "john.doe@example.com";

        // Sample Product List (Replace with database data)
        $items = [
            ["Product" => "Laptop", "Qty" => 1, "Price" => 1000.00],
            ["Product" => "Wireless Mouse", "Qty" => 1, "Price" => 50.00],
            ["Product" => "USB Keyboard", "Qty" => 1, "Price" => 40.00],
        ];

        // Calculate totals
        $subtotal = array_sum(array_column($items, 'Price'));
        $tax = $subtotal * 0.18; // 18% GST
        $totalAmount = $subtotal + $tax;

        // HTML Bill Format
        $html = '
        <style>
            body { font-family: Arial, sans-serif; }
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 20px;
                border: 1px solid #ddd;
                font-size: 16px;
                line-height: 24px;
                color: #555;
            }
            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }
            .invoice-box table td {
                padding: 8px;
                vertical-align: top;
            }
            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }
            .invoice-box table tr.item td{
                border-bottom: 1px solid #eee;
            }
            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #ddd;
                font-weight: bold;
            }
            .company-logo {
                text-align: center;
                margin-bottom: 20px;
            }
            .company-logo img {
                max-width: 150px;
            }
        </style>

        <div class="invoice-box">
            <div class="company-logo">
                <img src="https://yourwebsite.com/logo.png" alt="Company Logo">
                <h2>Your Company Name</h2>
                <p>123 Business Street, City, Country</p>
                <p>Phone: +1 800 123 4567 | Email: support@company.com</p>
            </div>
            
            <table>
                <tr class="heading">
                    <td>Invoice #</td>
                    <td>Date</td>
                </tr>
                <tr class="details">
                    <td>' . $invoiceNumber . '</td>
                    <td>' . $invoiceDate . '</td>
                </tr>

                <tr class="heading">
                    <td>Billing To:</td>
                    <td>Contact Details</td>
                </tr>
                <tr class="details">
                    <td>
                        ' . $customerName . '<br>
                        ' . $customerAddress . '
                    </td>
                    <td>
                        Phone: ' . $customerPhone . '<br>
                        Email: ' . $customerEmail . '
                    </td>
                </tr>

                <tr class="heading">
                    <td>Product</td>
                    <td>Price</td>
                </tr>';

        foreach ($items as $item) {
            $html .= '
                <tr class="item">
                    <td>' . $item["Product"] . ' (Qty: ' . $item["Qty"] . ')</td>
                    <td>$' . number_format($item["Price"], 2) . '</td>
                </tr>';
        }

        $html .= '
                <tr class="total">
                    <td>Subtotal:</td>
                    <td>$' . number_format($subtotal, 2) . '</td>
                </tr>
                <tr class="total">
                    <td>Tax (18% GST):</td>
                    <td>$' . number_format($tax, 2) . '</td>
                </tr>
                <tr class="total">
                    <td><strong>Total:</strong></td>
                    <td><strong>$' . number_format($totalAmount, 2) . '</strong></td>
                </tr>
            </table>

            <p><strong>Payment Instructions:</strong></p>
            <p>Bank Name: XYZ Bank</p>
            <p>Account No: 1234567890</p>
            <p>IFSC Code: XYZ123456</p>
            <p>Note: Please make the payment within 7 days of invoice date.</p>
        </div>';

        // Load HTML into Dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // Set paper size

        // Render the PDF
        $dompdf->render();

        // Send PDF as download response
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="test3.pdf"')
            ->setBody($dompdf->output());
    }
}
