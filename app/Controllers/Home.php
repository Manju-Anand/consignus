<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HomeModel;
use App\Models\PropertyModel;
use App\Models\CustomersModel;
use App\Models\ServiceModel;
use App\Models\LbmModel;
use App\Models\TransactionsModel;
use App\Models\SharetransactionhistoryModel;

class Home extends BaseController
{
    public $session;
    public $hmodel;
    public $propertymodel;
    public $custmodel;
    public $servicemodel;
    public $lbmmodel;
    public $transmodel;
    public $sharetransmodel;
    public function __construct()
    {
        // helper('form');
        // helper(['url', 'session']);

        $this->hmodel = new HomeModel();
        $this->propertymodel = new PropertyModel();
        $this->custmodel = new CustomersModel();
        $this->servicemodel = new ServiceModel();
        $this->lbmmodel = new LbmModel();
        $this->transmodel =  new TransactionsModel();
        $this->sharetransmodel = new SharetransactionhistoryModel();


        $this->session = \Config\Services::session();
    }
    public function index()
    {
         log_message('debug', 'logged_user session: ' . ($this->session->has('logged_user') ? 'yes' : 'no'));

    if (!$this->session->has('logged_user')) {
        log_message('debug', 'Redirecting to login from Home');
        return redirect()->to('/login');
    }
        $id = $this->session->get('logged_user');
        $userdata = $this->hmodel->getLoggedInUserData($id);
        $properties = $this->propertymodel->getPropertiesWithOneImage();
        $propertyCount = count($properties);
        $customers = $this->custmodel->getCustomer();
        $customercount = count($customers);
        $services = $this->servicemodel->getservice();
        $servicecount = count($services);
        $lbms = $this->lbmmodel->getLbm();
        $lbmcount = count($lbms);
        $transactions = $this->transmodel->gettransactions();
        $transactioncount = count($transactions);

        $typeDistribution = $this->propertymodel->getPropertyTypeDistribution();
        $monthlyPropertyStats = $this->propertymodel->getPropertiesListedPerMonth();
        $customerRegistrations = $this->custmodel->getCustomerRegistrationsLast6Months();
        $monthlyShareSales = $this->sharetransmodel->getMonthlyShareSales();
        $monthlySharetransactions = $this->sharetransmodel->getMonthlyShareTransactions();
        $coreTeamStats =  $this->lbmmodel->getCoreTeamStats();

        // print_r($userdata);
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "userdata" => $userdata,
            "propertyCount" => $propertyCount,
            "customercount" => $customercount,
            "servicecount" => $servicecount,
            "lbmcount" => $lbmcount,
            "transactioncount" => $transactioncount,
            "typeDistribution" => $typeDistribution,
            "monthlyPropertyStats" => $monthlyPropertyStats,
            "customerRegistrations" => $customerRegistrations,
            "monthlyShareSales" => $monthlyShareSales,
            "monthlySharetransactions" => $monthlySharetransactions,
             "coreTeamStats" => $coreTeamStats,
        ];

        // $this->logData('info', 'customers Data array', $data);
        return view('homeview', $data);
    }

    public function logout()
    {
        if (session()->has('logged_info')) {
            $la_id = session()->get('logged_info');
            $this->hmodel->updateLogoutTime($la_id);
        }
        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to('/login');
    }
}
