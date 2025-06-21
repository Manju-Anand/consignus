<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LbmModel;
use App\Models\LoginModel;
use App\Models\CustomersModel;
use App\Models\PropertyModel;
use App\Models\TeamassignmentModel;
use App\Models\HomeModel;
use App\Models\PropertimagesModel;
use App\Models\PropertytypeModel;


class LbmController extends BaseController
{
    public $lbmmodel;
    public $loginmodel;
    public $cmodel;
    public $pmodel;
    public $teammodel;
    public $hmodel;
    public $pimagesmodel;
    public $ptypemodel;
    public function __construct()
    {
        $this->lbmmodel = new LbmModel();
        $this->loginmodel = new LoginModel();
        $this->cmodel = new CustomersModel();
        $this->pmodel = new PropertyModel();
        $this->teammodel = new TeamassignmentModel();
        $this->hmodel = new HomeModel();
        $this->pimagesmodel = new PropertimagesModel();
        $this->ptypemodel = new PropertytypeModel();
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

    public function lbmuserview()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $lbmsusers = $this->loginmodel->where('designation', 'Lbm')->findAll();

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "lbmsusers" => $lbmsusers,
        ];

        return $this->renderView('lbm/lbmuserview', $data);
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

    // ====================================lbm panel ========================
    public function lbmpanel()
    {
       
        $lbms = $this->lbmmodel->getLbm();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "lbms" => $lbms,
        ];

        return $this->renderView('lbmpanel/loginview', $data);
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
            return view('lbmpanel/loginview', $data);
        } else {

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $result = $this->loginmodel->verifyemail($email);
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
                    $la_id = $this->loginmodel->saveLoginInfo($logininfo);
                    if ($la_id) {
                        $this->session->set('logged_info', $la_id);
                    }
                    $this->session->set('logged_user', $result->id);
                    $this->session->set('logged_lbmid', $result->lbmid);
                    return redirect()->to('lbmpanel/home');
                } else {
                    $this->session->setTempdata('failure', 'Sorry, wrong password', 3);
                    return redirect()->to('/lbmpanel');
                }
            } else {
                $this->session->setTempdata('failure', 'Sorry, eMAIL nOT FOUND', 3);
                return redirect()->to('/lbmpanel');
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

    public function homeview()
    {

        if (!$this->session->has('logged_user')) {
            log_message('debug', 'Redirecting to login from Home');
            return redirect()->to('/lbmpanel');
        }
        $id = $this->session->get('logged_user');
        $userdata = $this->hmodel->getLoggedInUserData($id);
        $properties = $this->pmodel->getPropertiesWithOneImage();
        $propertyCount = count($properties);
        $typeDistribution = $this->pmodel->getPropertyTypeDistribution();

        // print_r($userdata);
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "userdata" => $userdata,
            "propertyCount" => $propertyCount,
            "typeDistribution" => $typeDistribution,
        ];
        return view('lbmpanel/homeview', $data);
    }

    public function logout()
    {
        if (session()->has('logged_info')) {
            $la_id = session()->get('logged_info');
            $this->hmodel->updateLogoutTime($la_id);
        }
        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to('/lbmpanel');
    }

    public function propertylist()
    {
       
        $properties = $this->pmodel->getPropertiesWithOneImage();
        // Get search keyword
        $search = $this->request->getGet('search');
        // Filter properties based on search term
        $searchResults = [];
        if (!empty($search)) {
            foreach ($properties as $prop) {
                // Match against title, category, or any other fields
                if (
                    stripos($prop['title'], $search) !== false ||
                    stripos($prop['category'], $search) !== false
                ) {
                    $searchResults[] = $prop;
                }
            }
        }



        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "properties" => $properties,
            "search" => $search,
            "searchResults" => $searchResults
        ];

        // $this->logData('info', 'property idaa array', $data);
        return $this->renderView('lbmpanel/propertyview', $data);
    }
    public function viewproperty($pid)
    {
        $property = $this->pmodel->getproperty($pid);
        $propertyimages = $this->pimagesmodel->getpropertyimages($pid);
        $ptypes = $this->ptypemodel->getpropertytype();

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "property" => $property,
            "propertyimages" => $propertyimages,
            "ptype" => $ptypes,
        ];
        $this->logData('info', 'property data array', $data);
        return $this->renderView('lbmpanel/viewproperty', $data);
    }

    public function ajaxSearchProperty()
    {
        $search = $this->request->getGet('search');
        $db = \Config\Database::connect();

        // Base SQL builder
        $builder = $db->table('properties p')
            ->select(
                'p.*, 
            (SELECT image_path FROM property_images i 
             WHERE i.property_id = p.id 
             ORDER BY i.id ASC LIMIT 1) as image_path'
            );

        // Apply search filter if provided
        if (!empty($search)) {
            $builder->groupStart()
                ->like('p.title', $search)
                ->orLike('p.category', $search)
                ->groupEnd();
        }

        $properties = $builder->get()->getResultArray();

        $this->logData('info', 'property data array', $properties);
        return view('property/property_cards', ['properties' => $properties]);
    }
}
