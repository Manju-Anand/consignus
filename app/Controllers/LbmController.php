<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LbmModel;
use App\Models\LoginModel;
use App\Models\CustomersModel;
use App\Models\PropertyModel;
use App\Models\TeamassignmentModel;

class LbmController extends BaseController
{
    public $lbmmodel;
    public $loginmodel;
    public $cmodel;
    public $pmodel;
    public $teammodel;
    public function __construct()
    {
        $this->lbmmodel = new LbmModel();
        $this->loginmodel = new LoginModel();
        $this->cmodel = new CustomersModel();
        $this->pmodel = new PropertyModel();
        $this->teammodel = new TeamassignmentModel();
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $lbms = $this->lbmmodel->getLbm();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "lbms" => $lbms,
        ];

        return $this->renderView('lbm/lbmview', $data);
    }

    public function addlbm()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
        ];

        return $this->renderView('lbm/addlbm', $data);
    }


    public function savelbm()
    {
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "aname" => "required",
            "uname" => "required",
            "password" => "required",
            "aemail"  => "required|valid_email",
            "aphone" => "required|numeric|min_length[10]|max_length[15]",
            "status" => "required",
        ]);

        // Initialize data with page details
        $data = [
            "validation" => null, // Default null, will be set if validation fails
        ];



        if (!$this->validate($validation->getRules())) {
            // Add validation errors to $data array

            $data = [
                "meta_title" => "Consignus",
                "meta_description" => "Consignus",
                "validation" => $this->validator,
            ];

            return $this->renderView('lbm/addlbm', $data);
        } else {

            $file = $this->request->getFile('profile_image');
            $newName = "";
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Generate a new name or use the original
                $newName = $file->getRandomName(); // or $file->getClientName();
                // echo 'Trying to move to: ' . FCPATH . 'public/uploads/' . $newName;
                // Move the file to public/uploads folder
                $file->move(FCPATH . 'public\uploads\lbm', $newName);
            }

            $cdata = [
                'name' => $this->request->getVar('aname'),
                'email' =>  $this->request->getVar('aemail'),
                'contact_number' => $this->request->getVar('aphone'),
                'address' => $this->request->getVar('addr'),
                'business_name' => $this->request->getVar('bname'),
                'status' => $this->request->getVar('status'),
                'profile_pic' =>  $newName,
                'created_at' => date('Y-m-d h:i:s'),

            ];




            $lbm_id = $this->lbmmodel->insert($cdata);

            if ($lbm_id) {

                $userdata = [
                    'username' =>  $this->request->getVar('uname'),
                    'email' => $this->request->getVar('aemail'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'orgpd' => $this->request->getVar('password'),
                    'designation' => "Lbm",
                    'lbmid' => $lbm_id,
                    'cmded' => $this->request->getVar('password'),
                ];
                $this->loginmodel->insert($userdata);


                return redirect()->to('/lbm');
            }
        }
    }


    public function editlbm($pid)
    {
        $lbmlist = $this->lbmmodel->getlbmcomuserdata($pid);
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "lbmlist" => $lbmlist,

        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return $this->renderView('lbm/editlbm', $data);
    }

    public function updatelbm()
    {

        $file = $this->request->getFile('profile_image');
        $lbmid = $this->request->getVar('aid');
        $userid = $this->request->getVar('uid');

        if ($file && $file->isValid() && !$file->hasMoved()) {


            // Step 1: Get old profile pic from DB
            $lbm = $this->lbmmodel->find($lbmid); // Assumes you're using CI's Model::find() method
            if (!empty($staff['profile_pic'])) {
                $oldPath = FCPATH . 'public/uploads/lbm' . $lbm['profile_pic'];
                if (file_exists($oldPath)) {
                    unlink($oldPath); // Step 2: Delete old profile picture
                }
            }

            // Generate a new name or use the original
            $newName = $file->getRandomName(); // or $file->getClientName();
            // echo 'Trying to move to: ' . FCPATH . 'public/uploads/' . $newName;
            // Move the file to public/uploads folder
            $file->move(FCPATH . 'public\uploads\lbm', $newName);

            $cdata = [
                'name' => $this->request->getVar('aname'),
                'email' =>  $this->request->getVar('aemail'),
                'contact_number' => $this->request->getVar('aphone'),
                'address' => $this->request->getVar('addr'),
                'business_name' => $this->request->getVar('bname'),
                'status' => $this->request->getVar('status'),
                'profile_pic' =>  $newName,
                'created_at' => date('Y-m-d h:i:s'),

            ];
            $this->lbmmodel->updatelbm($lbmid, $cdata);
        } else {
            $cdata = [
                'name' => $this->request->getVar('aname'),
                'email' =>  $this->request->getVar('aemail'),
                'contact_number' => $this->request->getVar('aphone'),
                'address' => $this->request->getVar('addr'),
                'business_name' => $this->request->getVar('bname'),
                'status' => $this->request->getVar('status'),
                'created_at' => date('Y-m-d h:i:s'),

            ];
            $this->lbmmodel->updatelbm($lbmid, $cdata);
        }


        $userdata = [
            'username' =>  $this->request->getVar('uname'),
            'email' => $this->request->getVar('aemail'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'orgpd' => $this->request->getVar('password'),
            'designation' => "Lbm",
            'lbmid' => $lbmid,
            'cmded' => $this->request->getVar('password'),
        ];
        $this->loginmodel->update($userid, $userdata);


        return redirect()->to('/lbm');
    }
    public function deleteslbm($aid)
    {
        $result = $this->lbmmodel->deletelbm($aid);
        if ($result) {
            return redirect()->to('/lbm');
        }
    }

    public function viewDetails()
    {

        $id = $this->request->getPost('id');

        $staff = $this->lbmmodel->find($id);

        if (!$staff) {
            return $this->response->setStatusCode(404)->setBody('Staff not found');
        }

        return view('lbm/lbmview_modal', ['staff' => $staff]);
    }

    public function teamassign()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $lbms = $this->lbmmodel->getLbm();
        $customers = $this->cmodel->getCustomer();
        $property = $this->pmodel->getproperty();
        $teamassign = $this->lbmmodel->getteamassigndata();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "lbms" => $lbms,
            "customers" => $customers,
            "property" => $property,
            "teamassign" => $teamassign,
        ];
        $this->logData('info', 'Data array', $data);
        return $this->renderView('lbm/team_assignment', $data);
    }

    public function getcustomerDetails()
    {
        $id = $this->request->getPost('id');

        $customer = $this->cmodel->getCustomer($id);

        if ($customer) {
            return view('lbm/customer_detail_table', ['customer' => $customer]);
        } else {
            return 'No details found.';
        }
    }

    public function getPropertyDetails()
    {
        $id = $this->request->getPost('id');

        $property = $this->pmodel->getPropertyWithTypeDetails($id);
        $this->logData('info', 'property Data array', $property);
        if ($property) {
            return view('lbm/property_detail_table', ['property' => $property]);
        } else {
            return 'No details found.';
        }
    }

    public function saveteamassign()
    {
        // $validation = \Config\Services::validation();

        // // Set validation rules
        // $validation->setRules([
        //     "lbm" => "required",
        //     "customers" => "required",
        //     "property" => "required",
        // ]);

        // // Initialize data with page details
        // $data = [
        //     "validation" => null, // Default null, will be set if validation fails
        // ];



        // if (!$this->validate($validation->getRules())) {
        //     // Add validation errors to $data array
        //     $lbms = $this->lbmmodel->getLbm();
        //     $customers = $this->cmodel->getCustomer();
        //     $property = $this->pmodel->getproperty();
        //     $teamassign = $this->lbmmodel->getteamassigndata();
        //     $data = [
        //         "meta_title" => "Consignus",
        //         "meta_description" => "Consignus",
        //         "validation" => $this->validator,
        //         "lbms" => $lbms,
        //         "customers" => $customers,
        //         "property" => $property,
        //         "teamassign" => $teamassign,
        //     ];

        //     return $this->renderView('lbm/team_assignment', $data);
        // } else {



            $cdata = [
                'member_id' => $this->request->getVar('lbm'),
                'customer_id' =>  $this->request->getVar('customers'),
                'property_id' => $this->request->getVar('property'),
                'role' => $this->request->getVar('role'),
                'status' => "pending",
                'assigned_at' => date('Y-m-d h:i:s'),

            ];




            $lbm_id = $this->teammodel->insert($cdata);

            return redirect()->to('/team-assignment');
        // }
    }

    public function deleteteamassign($aid)
    {
        $result = $this->teammodel->delete($aid);
        if ($result) {
            return redirect()->to('/team-assignment');
        }
    }


    
}
