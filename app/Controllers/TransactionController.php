<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionsModel;
use App\Models\AccountheadsModel;
use App\Models\PaymentmodesModel;

class TransactionController extends BaseController
{
    public $transmodel;
    public $accountmodel;
    public $paymentmodel;
    public function __construct()
    {
        $this->transmodel =  new TransactionsModel();
        $this->accountmodel = new AccountheadsModel();
        $this->paymentmodel =  new PaymentmodesModel();
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $transactions = $this->transmodel->gettransactions();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "transactions" => $transactions,
        ];

        return $this->renderView('accounts/transactionview', $data);
    }
    public function transactionadd()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $accountshead = $this->accountmodel->findAll();
        $paymentmode = $this->paymentmodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "accountshead" => $accountshead,
            "paymentmode" => $paymentmode,

        ];

        return $this->renderView('accounts/addtransactions', $data);
    }

    public function savetransactions()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (
            empty($data['date']) || empty($data['transaction_type']) || empty($data['account_head_id']) ||
            empty($data['amount']) || empty($data['mode_id'])
        ) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        $headdata = [
            'date'   => $data['date'],
            'account_head_id'   => $data['account_head_id'],
            'description'   => $data['description'],
            'transaction_type'   => $data['transaction_type'],
            'amount'   => $data['amount'],
            'mode_id'   => $data['mode_id'],
            'reference_no'   => $data['reference_no'],
            'created_by'   => $data['payer_payee'],
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $this->transmodel->insert($headdata);

        return redirect()->to('/transactions-list')->with('success', 'Transaction Saved Successfully.');
    }

    public function deletetransactions($aid)
    {
        $result = $this->transmodel->delete($aid);
        if ($result) {
            return redirect()->to('/transactions-list')->with('success', 'Transaction Deleted Successfully.');
        }
    }

    public function edittransactions($pid)
    {
        $transactionitem = $this->transmodel->find($pid);
        $accountshead = $this->accountmodel->findAll();
        $paymentmode = $this->paymentmodel->findAll();


        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "transactionitem" => $transactionitem,
            "accountshead" => $accountshead,
            "paymentmode" => $paymentmode,
        ];

        return $this->renderView('accounts/edittransactions', $data);
    }

    public function updatetransactions()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (
            empty($data['date']) || empty($data['transaction_type']) || empty($data['account_head_id']) ||
            empty($data['amount']) || empty($data['mode_id'])
        ) {
            return redirect()->back()->with('error', 'All fields are required.');
        }
        $tid = $data['tid'];
        $headdata = [
            'date'   => $data['date'],
            'account_head_id'   => $data['account_head_id'],
            'description'   => $data['description'],
            'transaction_type'   => $data['transaction_type'],
            'amount'   => $data['amount'],
            'mode_id'   => $data['mode_id'],
            'reference_no'   => $data['reference_no'],
            'created_by'   => $data['payer_payee'],
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $this->transmodel->update( $tid, $headdata);

        return redirect()->to('/transactions-list')->with('success', 'Transaction Updated Successfully.');
    }

    public function incomeexpenditure()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
       
   
        $start_date = $this->request->getGet('start_date') ?? '';
        $end_date = $this->request->getGet('end_date') ?? '';

        $summary =  $this->transmodel->getIncomeExpenditureSummary($start_date, $end_date);

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "summary" => $summary,
            "start_date" => $start_date,
            "end_date" => $end_date
        ];
        // return view('accounts/incomeexpenditure', $data);
        // return view('accounts/incomeexpenditure', [
        //     'summary' => $summary,
        //     'start_date' => $start_date,
        //     'end_date' => $end_date
        // ]);

        return $this->renderView('accounts/incomeexpenditure', $data);
    }
}
