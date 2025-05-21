<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ShareModel;
use App\Models\ShareholdermasterModel;
use App\Models\SharepurchaseModel;
use App\Models\SharetransactionhistoryModel;
use App\Models\SharesaleModel;
use App\Models\TransactionsModel;

class ShareController extends BaseController
{
    public $sharemodel;
    public $shareholdermastermodel;
    public $sharepurchasemodel;
    public $sharetransactionhistorymodel;
    public $sharesalemodel;
    public $transmodel;
    public function __construct()
    {
        $this->sharemodel = new ShareModel();
        $this->shareholdermastermodel = new ShareholdermasterModel();
        $this->sharepurchasemodel = new SharepurchaseModel();
        $this->sharetransactionhistorymodel = new SharetransactionhistoryModel();
        $this->sharesalemodel = new SharesaleModel();
        $this->transmodel =  new TransactionsModel();
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
        // $this->logData('info', 'shares Data array', $data);
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
        // $this->logData('info', 'shares Data array', $data);
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

        $headdata = [
            'date'   => date('Y-m-d'),
            'account_head_id'   => "1",
            'description'   => "Share Purchase",
            'transaction_type'   => "share_purchase",
            'amount'   => $data['amount_invested'],
            'mode_id'   => "1",
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $this->transmodel->insert($headdata);


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
            'remaining_shares' => $data['remaining_shares']
        ]);
    }

    public function getShareholders($type)
    {
        $shareholders = $this->sharepurchasemodel
            ->where('shareholder_type', $type)
            //->groupBy('member_name')
            ->select('member_name, memberPhoneno, memberEmail, id, shares_allocated')
            ->findAll();

        return $this->response->setJSON($shareholders);
    }

    public function saveSharesales()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (
            empty($data['shareholder_name']) || empty($data['shareholder_phone']) || empty($data['shareholder_email']) ||
            empty($data['no_of_shares']) || empty($data['face_value']) || empty($data['saleamount'])
        ) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        $policy = $data['policy'];
        if ($policy == "buy_back") {
            $invester = "Company";
        } else {
            $invester = $data['investors'];
        }

        // Save purchase
        $saveData = [
            'shareholder_name'   => $data['shareholder_name'],
            'shareholder_type'   => $data['shareholder_type'],
            'phone_number'   => $data['shareholder_phone'],
            'email'   => $data['shareholder_email'],

            'shares_sold'    => $data['no_of_shares'],
            'sale_amount'   => $data['saleamount'],
            'sale_policy'    => $data['policy'],
            'sold_to'   => $invester,

            'remarks'   => $data['remarks'],
            'transaction_date'   => date('Y-m-d'),
            'created_at'         => date('Y-m-d H:i:s'),
            'purchaseid' => $data['shareholder_id'],

        ];
        $this->logData('info', 'Data array', $saveData);
        $this->sharesalemodel->save($saveData);
        $saleid = $this->sharesalemodel->insertID();

        $historydata = [
            'shareholder_name'   => $data['shareholder_name'],
            'shareholder_type'   => $data['shareholder_type'],
            'transaction_type'   => "sale",
            'shares'   => $data['no_of_shares'],
            'amount'    => $data['saleamount'],
            'policy'   => $data['policy'],
            'related_party' => $invester,
            'transaction_date'   => date('Y-m-d'),
            'created_at'         => date('Y-m-d H:i:s'),
            'transaction_id' => $saleid,
            'purchaseid' => $data['shareholder_id'],
        ];

        $this->sharetransactionhistorymodel->insert($historydata);

        $headdata = [
            'date'   => date('Y-m-d'),
            'account_head_id'   => "1",
            'description'   => "Share Sale",
            'transaction_type'   => "share_sale",
            'amount'   => $data['saleamount'],
            'mode_id'   => "1",
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $this->transmodel->insert($headdata);
        // return redirect()->back()->with('success', 'Share purchase saved successfully.');
        return redirect()->to('/share-sale-list')->with('success', 'Share Sale Saved successfully.');
    }


    public function getShareholderBalance($purchaseId)
    {
        $db = \Config\Database::connect();

        // Get allocated shares from purchase table
        $purchase = $db->table('share_purchase')
            ->select('shares_allocated')
            ->where('id', $purchaseId)
            ->get()
            ->getRow();

        // Get total sold shares from sales table
        $sold = $db->table('share_sales')
            ->selectSum('shares_sold')
            ->where('purchaseid', $purchaseId)
            ->get()
            ->getRow();

        $allocated = $purchase ? (int)$purchase->shares_allocated : 0;
        $soldShares = $sold && $sold->shares_sold ? (int)$sold->shares_sold : 0;
        $netShares = $allocated - $soldShares;

        return $this->response->setJSON([
            'allocated' => $allocated,
            'sold' => $soldShares,
            'net' => $netShares
        ]);
    }

    public function deletesale($aid)
    {
        // First, delete from the main share purchase model
        $result = $this->sharesalemodel->delete($aid);

        if ($result) {
            // Then delete from the transaction history table
            $this->sharetransactionhistorymodel->where('transaction_id', $aid)->delete();

            return redirect()->to('/share-sale-list')->with('success', 'Sales and history deleted successfully.');
        }

        return redirect()->back()->with('error', 'Failed to delete record.');
    }

    public function shareSummary($id)
    {

        // Load models
        $purchase = $this->sharepurchasemodel->where('id', $id)->first();

        if (!$purchase) {
            return $this->response->setJSON(['error' => 'Purchase not found']);
        }

        log_message('info', "purchased shares : " . $purchase['shares_allocated']);

        $sharetype = $purchase['shareholder_type'];
        $totalpurshares = $this->sharepurchasemodel
            ->selectSum('shares_allocated')
            ->where('shareholder_type', $sharetype)
            ->first();
        log_message('info', "total purchased shares based on type : " . $totalpurshares['shares_allocated']);


        // Get shares already sold
        $sold = $this->sharesalemodel
            ->selectSum('shares_sold')
            ->where('purchaseid', $id)
            ->first();

        log_message('info', "sell shares: " . $sold['shares_sold'] ?? 0);
        $totalsales = $this->sharesalemodel
            ->selectSum('shares_sold')
            ->where('shareholder_type', $sharetype)
            ->first();
        log_message('info', "total saled shares based on type : " . $totalsales['shares_sold']);




        $ownedShares = ($purchase['shares_allocated'] ?? 0) - ($sold['shares_sold'] ?? 0);
        log_message('info', "shares : " . $ownedShares);
        // Get face value based on shareholder type
        $shareholderType = $purchase['shareholder_type'];

        $shareholderMaster = $this->shareholdermastermodel
            ->where('type', $shareholderType)
            ->get()
            ->getRowArray();

        $faceValue = $shareholderMaster['face_value'] ?? 0;

        $availableShares = ($shareholderMaster['no_of_shares'] ?? 0) - (($totalpurshares['shares_allocated'] ?? 0) - ($totalsales['shares_sold'] ?? 0));
        log_message('info', "faceValue : " . $faceValue);
        log_message('info', "availableShares : " . $availableShares);
        return $this->response->setJSON([
            'face_value' => $faceValue,
            'owned_shares' => $ownedShares,
            'available_shares' => $availableShares,
        ]);
    }

    public function savenewaddedShares()
    {
        $data = $this->request->getPost();

        // Validate inputs
        if (empty($data['shares_to_add'])) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        $spid = $data['shareholder_id'];
        $sharespurchased = $data['shares_to_add'];
        $amtinvested = $data['amount_invested'];
        $sharetype = $data['shareholder_type'];
        $shareholder_name = $data['shareholder_name'];
        $totalsharespurchased = $data['total_shares_purcased'];
        $totalamtinvested = $data['total_amount_invested'];

        $this->sharepurchasemodel->update($spid, [
            'amount_invested' => $totalamtinvested,
            'shares_allocated' => $totalsharespurchased,
        ]);

        $historydata = [
            'shareholder_name'   => $shareholder_name,
            'shareholder_type'   => $sharetype,
            'transaction_type'   => "purchase",
            'shares'   => $sharespurchased,
            'amount'    => $amtinvested,
            'policy'   => "Added_Shares",
            'transaction_date'   => date('Y-m-d'),
            'created_at'         => date('Y-m-d H:i:s'),
            'transaction_id' => $spid,
        ];

        $this->sharetransactionhistorymodel->insert($historydata);


        // return redirect()->back()->with('success', 'Share purchase saved successfully.');
        return redirect()->to('/share-purchase-list')->with('success', 'Share purchase saved successfully.');
    }
}
