<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ArchitectModel;

class ArchitectController extends BaseController
{
    public $amodel;
    public function __construct()
    {
        $this->amodel = new ArchitectModel();
    }

    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $architects = $this->amodel->getArchitects();
        $data = [
            "meta_title" => "ArchFlow - Smart CRM Software for Architecture Firms",
            "meta_description" => "ArchFlow is a powerful CRM software designed for architecture firms to manage enquiries, site visits, quotations, 3D plans, revisions, and payments efficiently. Streamline your workflow with ArchFlow today!",
            "architects" => $architects,
        ];

        return $this->renderView('architects/architectview', $data);
    }

    public function addarchitects()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }

        $data = [
            "meta_title" => "ArchFlow - Smart CRM Software for Architecture Firms",
            "meta_description" => "ArchFlow is a powerful CRM software designed for architecture firms to manage enquiries, site visits, quotations, 3D plans, revisions, and payments efficiently. Streamline your workflow with ArchFlow today!",
          ];
  
        return $this->renderView('architects/addarchitect', $data);
    }

    public function savearchitect()
    {
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "aname" => "required",
            "aemail"     => "required|valid_email",
            "aphone" => "required|numeric|min_length[10]|max_length[15]",
            "arole"     => "required",
        ]);

        // Initialize data with page details
        $data = [
            "validation" => null, // Default null, will be set if validation fails
        ];

      

        if (!$this->validate($validation->getRules())) {
            // Add validation errors to $data array

            $data = [
                "meta_title" => "ArchFlow - Smart CRM Software for Architecture Firms",
                "meta_description" => "ArchFlow is a powerful CRM software designed for architecture firms to manage enquiries, site visits, quotations, 3D plans, revisions, and payments efficiently. Streamline your workflow with ArchFlow today!",
                "validation" => $this->validator,
            ];
           
            return $this->renderView('architects/addarchitect', $data);
        } else {

            $cdata = [
                'name'=>$this->request->getVar('aname'),
                'email' =>  $this->request->getVar('aemail'),
                'phone' => $this->request->getVar('aphone'),
                'role' => $this->request->getVar('arole'),
                'created_at' => date('Y-m-d h:i:s'),

            ];

            $result = $this->amodel->createarchitect($cdata);
            if ($result) {


                return redirect()->to('/architects');
            }
        }
    }

    public function editarchitect($pid){
        $architect = $this->amodel->getArchitect($pid);
        $data = [
            "meta_title" => "ArchFlow - Smart CRM Software for Architecture Firms",
            "meta_description" => "ArchFlow is a powerful CRM software designed for architecture firms to manage enquiries, site visits, quotations, 3D plans, revisions, and payments efficiently. Streamline your workflow with ArchFlow today!",
            "architect" => $architect,

        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return $this->renderView('architects/editarchitect', $data);


    }

    public function updatearchitect(){
        
        $aid = $this->request->getPost('aid'); // Ensure you're getting the correct ID
        $aname = $this->request->getPost('aname');
        $aemail = $this->request->getPost('aemail');
        $aphone = $this->request->getPost('aphone');
        $arole = $this->request->getPost('arole');
        $data = [
            'name' => $aname,
            'email' => $aemail,
            'phone' => $aphone,
            'role' => $arole,
        ];

        $this->amodel->update($aid, $data);

        return redirect()->to('/architects');

    }
    public function deletearchitect($aid){
        $result =$this->amodel->deletearchitect($aid);
        if ($result){
            return redirect()->to('/architects');
        }
    }

}
