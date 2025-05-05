<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ShareModel;
use App\Models\shareholdermastermodel;
use App\Models\SharetransactionsModel;

class ShareController extends BaseController
{
    public $sharemodel;
    public $shareholdermastermodel;
    public $sharetransactionmodel;
    public function __construct()
    {
        $this->sharemodel = new ShareModel();
        $this->shareholdermastermodel = new shareholdermastermodel();
        $this->sharetransactionmodel = new SharetransactionsModel();
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

    public function sharetransactions()
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
        return $this->renderView('shares/share_transactions', $data);
    }

    public function availableShares($type)
    {
        // log_message('info', 'This is a simple log message.');
        $master = $this->shareholdermastermodel->where('type', $type)->first();
        $sold = $this->sharetransactionmodel
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
        if (empty($data['member_name']) || empty($data['member_phno']) ||empty($data['member_email']) ||
        empty($data['shareholder_type']) || empty($data['amount_invested']) || empty($data['shares_allocated'])) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        // Save transaction
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

        $this->sharetransactionmodel->save($saveData);

        return redirect()->back()->with('success', 'Share transaction saved successfully.');
    }
}
