<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LeadsModel;
use App\Models\StaffModel;
use App\Models\AgentModel;
use App\Models\FollwupModel;

class LeadController extends BaseController
{
    public $leadmodel;
    public $staffmodel;
    public $agentmodel;
    public $followupmodel;
    public function __construct()
    {
        $this->leadmodel = new LeadsModel();
        $this->staffmodel = new StaffModel();
        $this->agentmodel = new AgentModel();
        $this->followupmodel = new FollwupModel();
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $leads = $this->leadmodel->getleads();

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "leads" => $leads,
        ];

        return $this->renderView('leads/leadview', $data);
    }

    public function addleads()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $staffs = $this->staffmodel->getStaff();
        $agents = $this->agentmodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "staffs" => $staffs,
            "agents" => $agents,
        ];

        return $this->renderView('leads/addleads', $data);
    }

    public function saveleads()
    {
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "aname" => "required",
            "addr" => "required",
            "budget" => "required",
            "aemail"  => "required|valid_email",
            "aphone" => "required|numeric|min_length[10]|max_length[15]",
            "requirement" => "required",
            "location" => "required",
            "lead" => "required",
            "edate" => "required",
            "astaff" => "required",
        ]);

        // Initialize data with page details
        $data = [
            "validation" => null, // Default null, will be set if validation fails
        ];

        if (!$this->validate($validation->getRules())) {
            // Add validation errors to $data array
            $staffs = $this->staffmodel->getStaff();
            $agents = $this->agentmodel->findAll();
            $data = [
                "meta_title" => "Consignus",
                "meta_description" => "Consignus",
                "validation" => $this->validator,
                "staffs" => $staffs,
                "agents" => $agents,
            ];

            return $this->renderView('leads/addleads', $data);
        } else {



            $cdata = [
                'name' => $this->request->getVar('aname'),
                'requirement_type' => $this->request->getVar('requirement'),
                'email' =>  $this->request->getVar('aemail'),
                'phone' => $this->request->getVar('aphone'),
                'address' => $this->request->getVar('addr'),
                'budget_range' => $this->request->getVar('budget'),
                'preferred_location' => $this->request->getVar('location'),
                'lead_source' => $this->request->getVar('lead'),
                'enquiry_date' =>  $this->request->getVar('edate'),
                'assigned_staff_id' => $this->request->getVar('astaff'),
                'created_at' => date('Y-m-d h:i:s'),
                'leadstatus' => 'Started',
                'agentid' => $this->request->getVar('agents'),
                'lead_purpose' => $this->request->getVar('lpurpose'),
                'referername' => $this->request->getVar('refername'),
            ];


            $this->leadmodel->insert($cdata);
            return redirect()->to('/leads');
        }
    }

    public function viewDetails()
    {

        $id = $this->request->getPost('id');

        $cust = $this->leadmodel->getleads($id);

        if (!$cust) {
            return $this->response->setStatusCode(404)->setBody('leads not found');
        }
        // Log the customer details
        log_message('info', 'Lead details: ' . print_r($cust, true));
        return view('leads/leadview_modal', ['cust' => $cust]);
    }

    public function editleads($pid)
    {
        $custlist = $this->leadmodel->getleads($pid);
        $staffs = $this->staffmodel->getStaff();
        $agents = $this->agentmodel->findAll();

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "custlist" => $custlist,
            "staffs" => $staffs,
            "agents" => $agents,

        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return $this->renderView('leads/editleads', $data);
    }

    public function updateleads()
    {

        $staffid = $this->request->getVar('aid');

        $cdata = [
            'name' => $this->request->getVar('aname'),
            'requirement_type' => $this->request->getVar('requirement'),
            'email' =>  $this->request->getVar('aemail'),
            'phone' => $this->request->getVar('aphone'),
            'address' => $this->request->getVar('addr'),
            'budget_range' => $this->request->getVar('budget'),
            'preferred_location' => $this->request->getVar('location'),
            'lead_source' => $this->request->getVar('lead'),
            'enquiry_date' =>  $this->request->getVar('edate'),
            'assigned_staff_id' => $this->request->getVar('astaff'),
            'created_at' => date('Y-m-d h:i:s'),
            'agentid' => $this->request->getVar('agents'),
            'leadstatus' => $this->request->getVar('leadstatus'),
            'lead_purpose' => $this->request->getVar('lpurpose'),
            'referername' => $this->request->getVar('refername'),
        ];
        $this->leadmodel->update($staffid, $cdata);

        $leadstatus = $this->request->getVar('leadstatus');
        if ($leadstatus == 'Started') {

            $this->followupmodel
                ->where('status', 'Converted')
                ->where('leads_id', $staffid)
                ->delete();
        }




        return redirect()->to('/leads');
    }

    public function deleteleads($aid)
    {
        $result = $this->leadmodel->delete($aid);
        if ($result) {
            return redirect()->to('/leads');
        }
    }


     public function leadexport()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $leads = $this->leadmodel->getleads();

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "leads" => $leads,
        ];

        return $this->renderView('leads/leadexport', $data);
    }
}
