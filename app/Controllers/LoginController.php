<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\LoginModel;

class LoginController extends BaseController
{
    public $session;
    public $loginModel;
    public function __construct()
    {
       
     

        $this->loginModel = new LoginModel();
        $this->session = \Config\Services::session();
    }

public function index()
{
 log_message('debug', 'Reached Login Page');

    return view('loginview'); // Your login form view
}




    public function processForm()
    {
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "email"     => "required|valid_email",
            "password"  => "required|min_length[4]|max_length[10]",

        ]);

        // Initialize data with page details
        $data = [
            "validation" => null, // Default null, will be set if validation fails
        ];

        if (!$this->validate($validation->getRules())) {
            // Add validation errors to $data array
            $data['validation'] = $this->validator;
            return view('loginview', $data);
        } else {

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $result = $this->loginModel->verifyemail($email);
            if ($result) {
                // print_r($result);
                // return "correct email";

                if (password_verify($password, $result->password)) {

                    $logininfo = [
                        "userid" => $result->id,
                        "agent" => $this->getUserAgentInfo(),
                        "ip" => $this->request->getIPAddress(),
                        "login_time" => date('Y-m-d h:i:s'),

                    ];
                    $la_id = $this->loginModel->saveLoginInfo($logininfo);
                    if ($la_id) {
                        $this->session->set('logged_info', $la_id);
                    }
                    $this->session->set('logged_user', $result->id);
                    return redirect()->to('/home');
                } else {
                    $this->session->setTempdata('failure', 'Sorry, wrong password', 3);
                    // return redirect()->to('/login');
                }
            } else {
                $this->session->setTempdata('failure', 'Sorry, eMAIL nOT FOUND', 3);
                // return redirect()->to('/login');
            }
        }
        // return "Form processed successfully!";
    }

    public function getUserAgentInfo()
    {
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } else {
            $currentAgent = "Unidentified User Agent";
        }
        return $currentAgent;
    }

    public function registration()
    {

        return view('registrationview');
    }
    public function registrationProcess()
    {
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "username" => "required",
            "email"     => "required|valid_email",
            "password"  => "required|min_length[4]|max_length[10]",

        ]);

        // Initialize data with page details
        $data = [
            "validation" => null, // Default null, will be set if validation fails
        ];

        if (!$this->validate($validation->getRules())) {
            // Add validation errors to $data array
            $data['validation'] = $this->validator;
            return view('registrationview', $data);
        } else {

            $cdata = [
                'username' =>  $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'orgpd' => $this->request->getVar('password'),
                
            ];

            $result = $this->loginModel->saveuserData($cdata);
            if ($result) {

                $insertedUserId = $result['user_id']; 

                $this->session->set('logged_info', $insertedUserId);
                $this->session->set('logged_user', $insertedUserId);
                    return redirect()->to('/home');

            }




        }

    }
}
