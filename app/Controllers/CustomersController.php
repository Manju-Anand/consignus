<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CustomersModel;
use App\Models\StaffModel;

class CustomersController extends BaseController
{
    public $custmodel;
    public $staffmodel;
    public function __construct()
    {
        $this->custmodel = new CustomersModel();
        $this->staffmodel = new StaffModel();
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $customers = $this->custmodel->getCustomer();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "customers" => $customers,
        ];

        return $this->renderView('customers/customerview', $data);
    }

    public function addcustomer()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $staffs = $this->staffmodel->getStaff();

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "staffs" => $staffs,
        ];

        return $this->renderView('customers/addcustomers', $data);
    }

    public function savecustomer()
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
            $data = [
                "meta_title" => "Consignus",
                "meta_description" => "Consignus",
                "validation" => $this->validator,
                "staffs" => $staffs,
            ];

            return $this->renderView('customers/addcustomers', $data);
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

            ];


            $this->custmodel->createCustomer($cdata);
            return redirect()->to('/customers');
        }
    }

    public function viewDetails()
    {

        $id = $this->request->getPost('id');

        $cust = $this->custmodel->find($id);

        if (!$cust) {
            return $this->response->setStatusCode(404)->setBody('customer not found');
        }

        return view('customers/customerview_modal', ['cust' => $cust]);
    }

    public function editcustomer($pid)
    {
        $custlist = $this->custmodel->getCustomer($pid);
        $staffs = $this->staffmodel->getStaff();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "custlist" => $custlist,
            "staffs" => $staffs,

        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return $this->renderView('customers/editcustomers', $data);
    }

    public function updatecustomer()
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

        ];
        $this->custmodel->updateCustomer($staffid, $cdata);
 
        return redirect()->to('/customers');
    }

    public function deletecustomer($aid){
        $result =$this->custmodel->deleteCustomer($aid);
        if ($result){
            return redirect()->to('/customers');
        }
    }
}
