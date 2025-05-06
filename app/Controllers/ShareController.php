<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ShareModel;
use App\Models\shareholdermastermodel;
use App\Models\SharepurchaseModel;
use App\models\SharetransactionhistoryModel;
use App\Models\SharesaleModel;

class ShareController extends BaseController
{
    public $sharemodel;
    public $shareholdermastermodel;
    public $sharepurchasemodel;
    public $sharetransactionhistorymodel;
    public $sharesalemodel;
    public function __construct()
    {
        $this->sharemodel = new ShareModel();
        $this->shareholdermastermodel = new shareholdermastermodel();
        $this->sharepurchasemodel = new SharepurchaseModel();
        $this->sharetransactionhistorymodel = new SharetransactionhistoryModel();
        $this->sharesalemodel = new SharesaleModel();
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $fy = $this->sharemodel->getfinancialyear();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "fy" => $fy,
        ];

        return $this->renderView('shares/companyvaluation', $data);
    }

    public function saveAll()
    {
        $rows = $this->request->getPost('rows');


        // Step 1: Delete all existing records
        $this->sharemodel->truncate(); // or use $model->where('id !=', 0)->delete(); if you prefer

        // Step 2: Insert each row
        $insertData = [];

        foreach ($rows as $row) {
            if (!empty($row['financial_year']) && !empty($row['valuation'])) {
                $insertData[] = [
                    'financial_year' => $row['financial_year'],
                    'valuation'      => $row['valuation'],
                    'created_at'     => date('Y-m-d H:i:s')
                ];
            }
        }

        if (!empty($insertData)) {
            $this->sharemodel->insertBatch($insertData);
        }

        return redirect()->back()->with('message', 'All data saved successfully.');
    }

    public function shareholdermaster()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $sharemasters = $this->shareholdermastermodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "sharemasters" => $sharemasters,
        ];
        $this->logData('info', 'shares Data array', $data);
        return $this->renderView('shares/shareholder_master', $data);
    }

    public function saveshareholder()
    {
        $data = $this->request->getPost('master');

        foreach ($data as $type => $entry) {
            $existing = $this->shareholdermastermodel->where('type', $type)->first();

            $saveData = [
                'type' => $type,
                'no_of_shares' => $entry['no_of_shares'],
                'face_value' => $entry['face_value'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($existing) {
                $this->shareholdermastermodel->update($existing['id'], $saveData);
            } else {
                $saveData['created_at'] = date('Y-m-d H:i:s');
                $this->shareholdermastermodel->insert($saveData);
            }
        }

        return redirect()->back()->with('success', 'Master Shareholder Data Saved Successfully.');
    }

    public function sharepurchaselist()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $purchaselist = $this->sharepurchasemodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "purchaselist" => $purchaselist,
        ];
        $this->logData('info', 'shares Data array', $data);
        return $this->renderView('shares/sharepurchaselist', $data);
    }

    public function sharepurchase()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        // $sharemasters = $this->shareholdermastermodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            // "sharemasters" => $sharemasters,
        ];
        $this->logData('info', 'shares Data array', $data);
        return $this->renderView('shares/share_purchase', $data);
    }

    public function availableShares($type)
    {
        // log_message('info', 'This is a simple log message.');
        $master = $this->shareholdermastermodel->where('type', $type)->first();
        $sold = $this->sharepurchasemodel
            ->where('shareholder_type', $type)
            ->selectSum('shares_allocated')
            ->first();

        // log_message('info', 'This is a simple log message.');
        if (!$master) {
            return $this->response->setJSON([
                'error' => 'Shareholder type not found in master table.'
            ]);
        }

        $soldShares = $sold['shares_allocated'] ?? 0;
        $remaining = $master['no_of_shares'] - $soldShares;

        return $this->response->setJSON([
            'face_value' => $master['face_value'],
            'remaining' => $remaining,
        ]);
    }

    public function saveShareTransaction()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (
            empty($data['member_name']) || empty($data['member_phno']) || empty($data['member_email']) ||
            empty($data['shareholder_type']) || empty($data['amount_invested']) || empty($data['shares_allocated'])
        ) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        // Save purchase
        $saveData = [
            'member_name'   => $data['member_name'],
            'memberPhoneno'   => $data['member_phno'],
            'memberEmail'   => $data['member_email'],
            'shareholder_type'   => $data['shareholder_type'],
            'amount_invested'    => $data['amount_invested'],
            'shares_allocated'   => $data['shares_allocated'],
            'transaction_date'   => date('Y-m-d'),
            'created_at'         => date('Y-m-d H:i:s'),
        ];

        $this->sharepurchasemodel->save($saveData);
        $purchaseid = $this->sharepurchasemodel->insertID();

        $historydata = [
            'shareholder_name'   => $data['member_name'],
            'shareholder_type'   => $data['shareholder_type'],
            'transaction_type'   => "purchase",
            'shares'   => $data['shares_allocated'],
            'amount'    => $data['amount_invested'],
            'policy'   => "direct_purchase",
            'transaction_date'   => date('Y-m-d'),
            'created_at'         => date('Y-m-d H:i:s'),
            'transaction_id' => $purchaseid
        ];

        $this->sharetransactionhistorymodel->insert($historydata);


        // return redirect()->back()->with('success', 'Share purchase saved successfully.');
        return redirect()->to('/share-purchase-list')->with('success', 'Share purchase Saved successfully.');
    }


    public function editpurchase($pid)
    {
        $purchaseitem = $this->sharepurchasemodel->find($pid);


        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "purchaseitem" => $purchaseitem,

        ];
        $this->logData('info', 'property data array', $data);
        return $this->renderView('shares/edit_share_purchase', $data);
    }

    public function updatepurchase()
    {

        $purchaseid = $this->request->getVar('pid');

        $errors = [];

        if (empty($this->request->getVar('member_name'))) $errors[] = 'Member name is required.';
        if (empty($this->request->getVar('member_phno'))) $errors[] = 'Phone number is required.';
        if (empty($this->request->getVar('member_email'))) $errors[] = 'Email is required.';
        if (empty($this->request->getVar('shareholder_type'))) $errors[] = 'Shareholder type is required.';
        if (empty($this->request->getVar('amount_invested'))) $errors[] = 'Amount invested is required.';
        if (empty($this->request->getVar('shares_allocated'))) $errors[] = 'Shares allocated is required.';

        if (!empty($errors)) {
            return redirect()->back()->with('error', implode('<br>', $errors));
        }


        $saveData = [
            'member_name'   => $this->request->getVar('member_name'),
            'memberPhoneno'   => $this->request->getVar('member_phno'),
            'memberEmail'   => $this->request->getVar('member_email'),
            'shareholder_type'   => $this->request->getVar('shareholder_type'),
            'amount_invested'    => $this->request->getVar('amount_invested'),
            'shares_allocated'   => $this->request->getVar('shares_allocated'),
            'transaction_date'   => date('Y-m-d'),
            'modified_at'         => date('Y-m-d H:i:s'),
        ];

        $this->sharepurchasemodel->update($purchaseid, $saveData);
        $historydata = [
            'shareholder_name'   => $this->request->getVar('member_name'),
            'shareholder_type'   => $this->request->getVar('shareholder_type'),
            'shares'   => $this->request->getVar('shares_allocated'),
            'amount'    => $this->request->getVar('amount_invested'),
        ];

        $this->sharetransactionhistorymodel
            ->where('transaction_id', $purchaseid)
            ->set($historydata)
            ->update();
        // return redirect()->back()->with('success', 'Share purchase Updated successfully.');
        return redirect()->to('/share-purchase-list')->with('success', 'Share purchase Updated successfully.');
    }

    public function deletepurchase($aid)
    {
        // First, delete from the main share purchase model
        $result = $this->sharepurchasemodel->delete($aid);

        if ($result) {
            // Then delete from the transaction history table
            $this->sharetransactionhistorymodel->where('transaction_id', $aid)->delete();

            return redirect()->to('/share-purchase-list')->with('success', 'Purchase and history deleted successfully.');
        }

        return redirect()->back()->with('error', 'Failed to delete record.');
    }


    // ************************************************

    public function sharesaleslist()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $saleslist = $this->sharesalemodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "saleslist" => $saleslist,
        ];
        // $this->logData('info', 'shares Data array', $data);
        return $this->renderView('shares/sharesaleslist', $data);
    }

    public function sharesale()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        // $sharemasters = $this->shareholdermastermodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            // "sharemasters" => $sharemasters,
        ];
        // $this->logData('info', 'shares Data array', $data);
        return $this->renderView('shares/share_sale', $data);
    }
    public function faceValue($type)
    {

        // log_message('info', 'This is a custom info log message.');
        $shareholderModel = new \App\Models\ShareholderMasterModel();
        $data = $shareholderModel->getSharesOwnedByType($type);
       
        if ($data === null) {
            return $this->response->setJSON(['error' => 'Invalid shareholder type.']);
        }
    
        return $this->response->setJSON([
            'face_value'      => $data['face_value'],
            'shares_owned'    => $data['allocated_shares'],
            'remaining_shares'=> $data['remaining_shares']
        ]);
    }
    
}
