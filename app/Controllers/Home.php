<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\HomeModel;

class Home extends BaseController
{
    public $session;
    public $hmodel;
    public function __construct()
    {
        helper('form');
        helper(['url', 'session']);

        $this->hmodel = new HomeModel();
        $this->session = \Config\Services::session();
    }
    public function index(): string
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');

        }
        $id = $this->session->get('logged_user');
        $userdata = $this->hmodel->getLoggedInUserData($id);
       
        // print_r($userdata);
        $data = [
            "meta_title" => "ArchFlow - Smart CRM Software for Architecture Firms",
            "meta_description" => "ArchFlow is a powerful CRM software designed for architecture firms to manage enquiries, site visits, quotations, 3D plans, revisions, and payments efficiently. Streamline your workflow with ArchFlow today!",
            "userdata" => $userdata,
        ];
        return view('homeview',$data);
    }

    public function logout()
    {
        if(session()->has('logged_info')){
            $la_id= session()->get('logged_info');
            $this->hmodel->updateLogoutTime($la_id);
        }
        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to('/login');
    }
}
