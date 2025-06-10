<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TeamassignmentModel;
use App\Models\TeamworkModel;
use App\Models\SitevisitexpenseModel;


class TeamworkController extends BaseController
{
    public $teamssignmodel;
    public $teamupdatemodel;
    public $sitevisitexpensemodel;
    public function __construct()
    {
        $this->teamssignmodel = new TeamassignmentModel();
        $this->teamupdatemodel = new TeamworkModel();
        $this->sitevisitexpensemodel = new SitevisitexpenseModel();
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }

        $teamassign = $this->teamupdatemodel->getteamworkupdates();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",

            "teamassign" => $teamassign,
        ];
        $this->logData('info', 'Data array', $data);
        return $this->renderView('lbm/teamworkupdateview', $data);
    }
    public function teamworkupdate($id)
    {
        $teamassign = $this->teamupdatemodel->getteamworkupdateswithid($id);

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "teamassign" => $teamassign,
        ];

        // $this->logData('info', 'Data array', $data);
        return $this->renderView('lbm/teamworkupdate', $data);
    }
    public function saveteamworkupdate()
    {
        $teamworkupdate = [
            'assignment_id' => $this->request->getVar('assignid'),
            'work_notes' => $this->request->getVar('worknotes'),
            'submitted_at' => $this->request->getVar('udate'),
            'perinvolvement' => $this->request->getVar('involvementpercentage'),
            'remuneration' => $this->request->getVar('remuneration'),
        ];

        $teamworkupdate_id = $this->teamupdatemodel->insert($teamworkupdate);

        if ($teamworkupdate_id) {
            $descriptions = $this->request->getVar('description');
            $expense_type = $this->request->getVar('expense_type');
            $unit_prices = $this->request->getVar('unit_price');
            $total_prices = $this->request->getVar('total_price');

            if (!empty($descriptions)) {
                foreach ($descriptions as $index => $description) {
                    $quotationItemData = [
                        'twu_id' => $teamworkupdate_id,
                        'description' => $description,
                        'expense_type' => $expense_type[$index],
                        'amount' => $unit_prices[$index],
                        'total_price' => $total_prices[$index],
                        'expense_date' => $this->request->getVar('udate'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'lbm_id' => $this->request->getVar('lbmid'),
                    ];
                    $this->sitevisitexpensemodel->insert($quotationItemData);
                }
            }
            return redirect()->to('/team-work-update')->with('success', 'Quotation saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Error in saving quotation.');
        }
    }

    public function lbmcontribution()
    {

        $teamassign = $this->teamupdatemodel->getlbmcontribution();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",

            "teamassign" => $teamassign,
        ];
        $this->logData('info', 'Data array', $data);
        return $this->renderView('lbm/lbmcontribution', $data);
    }
    public function companyliability()
    {


        $liabilityList = $this->teamupdatemodel->companyliabilitylist();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",

            "liabilityList" => $liabilityList,
        ];
        $this->logData('info', 'Data array', $data);
        return $this->renderView('lbm/companyliabilitylist', $data);
    }
    public function liabilityconvertion()
    {


        $liabilityList = $this->teamupdatemodel->companyliabilitylist();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",

            "liabilityList" => $liabilityList,
        ];
        // $this->logData('info', 'Data array', $data);
        return $this->renderView('accounts/liabilitylistconvertion', $data);
    }

    public function saveSelected()
    {
        $data = $this->request->getJSON(true);
        $this->logData('info', 'Data array', $data);
        if (!isset($data['data']) || !is_array($data['data'])) {
            return $this->response->setJSON(['success' => false]);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('selected_liabilities');

        foreach ($data['data'] as $row) {
            $builder->insert([
                'twu_id' => $row['twu_id'] ?? null,
                'lname' => $row['lname'] ?? '',
                'title' => $row['title'] ?? '',
                'role' => $row['role'] ?? '',
                'remuneration' => $row['remuneration'] ?? null,
                'remuneration_date' => $row['remuneration_date'] ?? null,
                'expense_type' => $row['expense_type'] ?? '',
                'expense_amount' => $row['expense_amount'] ?? null,
                'expense_date' => $row['expense_date'] ?? null,
                'expense_status' => $row['expense_status'] ?? '',
                'work_status' => $row['work_status'] ?? '',
            ]);
        }

        return $this->response->setJSON(['success' => true]);
    }
}
