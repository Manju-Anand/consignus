<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CustomersModel;
use App\Models\StaffModel;
use App\Models\FollwupModel;

class FollowupController extends BaseController
{
    public $custmodel;
    public $staffmodel;
    public $followupmodel;
    public function __construct()
    {
        $this->custmodel = new CustomersModel();
        $this->staffmodel = new StaffModel();
        $this->followupmodel = new  FollwupModel();
    }
    public function viewfollowup($id)
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $customers = $this->custmodel->getCustomer($id);
        $followups = $this->followupmodel->getfollowupwithcid($id);
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "customers" => $customers,
            "followups" => $followups,
        ];
        $this->logData('info', 'customers Data array', $data);
        return $this->renderView('customers/followupcustomers', $data);
    }

    public function savefollowup()
    {
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "fdate" => "required",
            "fstatus" => "required",
            "communication" => "required",
        ]);

        // Initialize data with page details
        $data = [
            "validation" => null, // Default null, will be set if validation fails
        ];

        if (!$this->validate($validation->getRules())) {
            // Add validation errors to $data array
            $id = $this->request->getVar('aid');
            $customers = $this->custmodel->getCustomer($id);
            $followups = $this->followupmodel->getfollowupwithcid($id);
            $data = [
                "meta_title" => "Consignus",
                "meta_description" => "Consignus",
                "validation" => $this->validator,
                "customers" => $customers,
                "followups" => $followups,
            ];

            return $this->renderView('customers/followupcustomers', $data);
        } else {



            $cdata = [
                'follow_up_date' => $this->request->getVar('fdate'),
                'next_follow_up_date' => $this->request->getVar('nfdate'),
                'communication_mode' =>  $this->request->getVar('communication'),
                'notes' => $this->request->getVar('notes'),
                'status' => $this->request->getVar('fstatus'),
                'customer_id' => $this->request->getVar('aid') ,
                'created_at' => date('Y-m-d h:i:s'),

            ];


            $this->followupmodel->createFollowup($cdata);
            return redirect()->to('/customers');
        }
    }

    public function deletefollowup($aid){
        $result =$this->followupmodel->deleteFollowup($aid);
        if ($result){
            return redirect()->to('/customers');
        }
    }
}
