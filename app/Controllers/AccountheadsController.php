<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AccountheadsModel;
use App\Models\PaymentmodesModel;

class AccountheadsController extends BaseController
{
    public $accountmodel;
    public $paymentmodel;
    public function __construct()
    {
        $this->accountmodel = new AccountheadsModel();
        $this->paymentmodel =  new PaymentmodesModel();
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $accountheads = $this->accountmodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "accountheads" => $accountheads,
        ];

        return $this->renderView('accounts/accountheadslist', $data);
    }

    public function saveaccountheads()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (empty($data['head_name']) || empty($data['head_type'])) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        $headdata = [
            'head_name'   => $data['head_name'],
            'head_type'   => $data['head_type'],
            'description'   => $data['description'],
            'is_active'   => $data['is_active'],
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $this->accountmodel->insert($headdata);

        return redirect()->to('/account-heads')->with('success', 'Account Head Saved Successfully.');
    }

    public function deleteaccounthead($aid)
    {
        $result = $this->accountmodel->delete($aid);
        if ($result) {
            return redirect()->to('/account-heads')->with('success', 'Account Head Deleted Successfully.');
        }
    }

    public function updateaccountheads()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (empty($data['edithead_name']) || empty($data['edithead_type'])) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        $headid = $data['head_id'];
        $headdata = [
            'head_name'   => $data['edithead_name'],
            'head_type'   => $data['edithead_type'],
            'description'   => $data['editdescription'],
            'is_active'   => $data['editis_active'],
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $this->accountmodel->update($headid, $headdata);

        return redirect()->to('/account-heads')->with('success', 'Account Head Updated Successfully.');
    }




    //    ********************** Payment Modes *************************
    public function paymentmodes() {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $paymentmodel = $this->paymentmodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "paymentmodel" => $paymentmodel,
        ];

        return $this->renderView('accounts/paymentmodeslist', $data);
    }

    public function savepaymentmodes()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (empty($data['mode_name'])) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        $headdata = [
            'mode_name'   => $data['mode_name'],
            'description'   => $data['details'],
             'created_at'   => date('Y-m-d H:i:s'),
        ];

        $this->paymentmodel->insert($headdata);

        return redirect()->to('/payment-modes')->with('success', 'Payment Mode Saved Successfully.');
    }

    public function deletepaymentmodes($aid)
    {
        $result = $this->paymentmodel->delete($aid);
        if ($result) {
            return redirect()->to('/payment-modes')->with('success', 'Payment Mode Deleted Successfully.');
        }
    }

    public function updatepaymentmodes()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (empty($data['editmodeName']) ) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        $pmid = $data['pmid'];
        $headdata = [
            'mode_name'   => $data['editmodeName'],
            'description'   => $data['editdetails'],
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $this->paymentmodel->update($pmid, $headdata);

        return redirect()->to('/payment-modes')->with('success', 'Account Head Updated Successfully.');
    }
}
