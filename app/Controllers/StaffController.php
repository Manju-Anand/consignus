<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StaffModel;
use App\Models\LoginModel;

class StaffController extends BaseController
{
    public $staffmodel;
    public $loginmodel;
    public function __construct()
    {
        $this->staffmodel = new StaffModel();
        $this->loginmodel = new LoginModel();
    }

    public function index()
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

        return $this->renderView('staff/staffview', $data);
    }
    public function addstaff()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
        ];

        return $this->renderView('staff/addstaff', $data);
    }

    public function savestaff()
    {
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "aname" => "required",
            "uname" => "required",
            "password" => "required",
            "aemail"  => "required|valid_email",
            "aphone" => "required|numeric|min_length[10]|max_length[15]",
            "role"     => "required",
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

            return $this->renderView('staff/addstaff', $data);
        } else {

            $file = $this->request->getFile('profile_image');
            $newName = "";
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Generate a new name or use the original
                $newName = $file->getRandomName(); // or $file->getClientName();
                // echo 'Trying to move to: ' . FCPATH . 'public/uploads/' . $newName;
                // Move the file to public/uploads folder
                $file->move(FCPATH . 'public\uploads', $newName);
            }

            $cdata = [
                'full_name' => $this->request->getVar('aname'),
                'username' => $this->request->getVar('uname'),
                'email' =>  $this->request->getVar('aemail'),
                'phone' => $this->request->getVar('aphone'),
                'address' => $this->request->getVar('addr'),
                'role' => $this->request->getVar('role'),
                'department' => $this->request->getVar('dept'),
                'status' => $this->request->getVar('status'),
                'profile_pic' =>  $newName,
                'date_joined' => $this->request->getVar('jdate'),
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d h:i:s'),

            ];




            $staff_id = $this->staffmodel->insert($cdata);

            if ($staff_id) {

                $userdata = [
                    'username' =>  $this->request->getVar('uname'),
                    'email' => $this->request->getVar('aemail'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'orgpd' => $this->request->getVar('password'),
                    'designation' => $this->request->getVar('role'),
                    'empid' => $staff_id,
                    'cmded' => $this->request->getVar('password'),
                ];
                $this->loginmodel->insert($userdata);


                return redirect()->to('/staff');
            }
        }
    }

    public function viewDetails()
    {

        $id = $this->request->getPost('id');

        $staff = $this->staffmodel->find($id);

        if (!$staff) {
            return $this->response->setStatusCode(404)->setBody('Staff not found');
        }

        return view('staff/staffview_modal', ['staff' => $staff]);
    }

    public function editstaff($pid)
    {
        $stafflist = $this->staffmodel->getstaffcomuserdata($pid);
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "stafflist" => $stafflist,

        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return $this->renderView('staff/editstaff', $data);
    }

    public function updatestaff()
    {

        $file = $this->request->getFile('profile_image');
        $staffid = $this->request->getVar('aid');
        $userid = $this->request->getVar('uid');
        $newName = "";
        if ($file && $file->isValid() && !$file->hasMoved()) {


            // Step 1: Get old profile pic from DB
            $staff = $this->staffmodel->find($staffid); // Assumes you're using CI's Model::find() method
            if (!empty($staff['profile_pic'])) {
                $oldPath = FCPATH . 'public/uploads/' . $staff['profile_pic'];
                if (file_exists($oldPath)) {
                    unlink($oldPath); // Step 2: Delete old profile picture
                }
            }

            // Generate a new name or use the original
            $newName = $file->getRandomName(); // or $file->getClientName();
            // echo 'Trying to move to: ' . FCPATH . 'public/uploads/' . $newName;
            // Move the file to public/uploads folder
            $file->move(FCPATH . 'public\uploads', $newName);

            $cdata = [
                'full_name' => $this->request->getVar('aname'),
                'username' => $this->request->getVar('uname'),
                'email' =>  $this->request->getVar('aemail'),
                'phone' => $this->request->getVar('aphone'),
                'address' => $this->request->getVar('addr'),
                'role' => $this->request->getVar('role'),
                'department' => $this->request->getVar('dept'),
                'status' => $this->request->getVar('status'),
                'profile_pic' =>  $newName,
                'date_joined' => $this->request->getVar('jdate'),
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d h:i:s'),

            ];
            $this->staffmodel->updateStaff($staffid, $cdata);
        } else {
            $cdata = [
                'full_name' => $this->request->getVar('aname'),
                'username' => $this->request->getVar('uname'),
                'email' =>  $this->request->getVar('aemail'),
                'phone' => $this->request->getVar('aphone'),
                'address' => $this->request->getVar('addr'),
                'role' => $this->request->getVar('role'),
                'department' => $this->request->getVar('dept'),
                'status' => $this->request->getVar('status'),
                'date_joined' => $this->request->getVar('jdate'),
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d h:i:s'),

            ];
            $this->staffmodel->updateStaff($staffid, $cdata);
        }








        $userdata = [
            'username' =>  $this->request->getVar('uname'),
            'email' => $this->request->getVar('aemail'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'orgpd' => $this->request->getVar('password'),
            'designation' => $this->request->getVar('role'),
            'empid' => $staffid,
            'cmded' => $this->request->getVar('password'),
        ];
        $this->loginmodel->update($userid, $userdata);


        return redirect()->to('/staff');
    }

    public function deletestaff($aid)
    {
        $result = $this->staffmodel->deleteStaff($aid);
        if ($result) {
            return redirect()->to('/staff');
        }
    }
}
