<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CustomersModel;
use App\Models\StaffModel;
use App\Models\FollwupModel;
use App\Models\LeadsModel;
use App\Models\PropertyModel;
use App\Models\ServiceModel;
use App\Models\TransactionsModel;
use App\Models\PaymentmodesModel;

class FollowupController extends BaseController
{
    public $leadmodel;
    public $custmodel;
    public $staffmodel;
    public $followupmodel;
    public $propertymodel;
    public $servicemodel;
    public $transmodel;
    public $paymentmodel;
    public function __construct()
    {
        $this->custmodel = new CustomersModel();
        $this->staffmodel = new StaffModel();
        $this->followupmodel = new  FollwupModel();
        $this->leadmodel = new LeadsModel();
        $this->propertymodel = new PropertyModel();
        $this->servicemodel = new ServiceModel();
        $this->transmodel =  new TransactionsModel();
        $this->paymentmodel =  new PaymentmodesModel();
    }
    public function viewfollowup($id)
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $customers = $this->leadmodel->getleads($id);
        $followups = $this->followupmodel->getfollowupwithcid($id);
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "customers" => $customers,
            "followups" => $followups,
        ];
        $this->logData('info', 'customers Data array', $data);
        return $this->renderView('leads/followupleads', $data);
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
            $customers = $this->leadmodel->getleads($id);
            $followups = $this->followupmodel->getfollowupwithcid($id);
            $data = [
                "meta_title" => "Consignus",
                "meta_description" => "Consignus",
                "validation" => $this->validator,
                "customers" => $customers,
                "followups" => $followups,
            ];

            return $this->renderView('leads/followupleads', $data);
        } else {



            $cdata = [
                'follow_up_date' => $this->request->getVar('fdate'),
                'next_follow_up_date' => $this->request->getVar('nfdate'),
                'communication_mode' =>  $this->request->getVar('communication'),
                'notes' => $this->request->getVar('notes'),
                'status' => $this->request->getVar('fstatus'),
                'leads_id' => $this->request->getVar('aid'),
                'created_at' => date('Y-m-d h:i:s'),

            ];
            log_message('info', 'save Lead details: ' . print_r($cdata, true));

            $result = $this->followupmodel->createFollowup($cdata);
            if ($result) {
                return redirect()->to('/leads');
            }
        }
    }

    public function deletefollowup($aid)
    {
        $result = $this->followupmodel->deleteFollowup($aid);
        if ($result) {
            return redirect()->to('/leads');
        }
    }
    public function convertion($aid)
    {
        $leads = $this->leadmodel->getleads($aid);

        $this->leadmodel->update($aid, ['leadstatus' => 'Converted']);

        // =======================followup save ========================
        $fdata = [
            'follow_up_date' => $this->request->getPost('fdate'),
            'next_follow_up_date' => $this->request->getPost('nfdate'),
            'communication_mode' =>  $this->request->getPost('communication'),
            'notes' => $this->request->getPost('notes'),
            'status' => $this->request->getPost('fstatus'),
            'leads_id' =>  $aid,
            'created_at' => date('Y-m-d h:i:s'),

        ];
        log_message('info', 'save Lead details: ' . print_r($fdata, true));

        $this->followupmodel->createFollowup($fdata);

        // ===================customer save================================

        $cdata = [
            'lead_id' => $aid,
            'name' => $leads['name'],        // from $leads
            'email' => $leads['email'],
            'phone' => $leads['phone'],
            'address' => $leads['address'],
            'created_at' => date('Y-m-d h:i:s'),
        ];

        $this->custmodel->createCustomer($cdata);
        $customer_id = $this->custmodel->insertID();

        log_message('info', 'New customer ID: ' . $customer_id);

        // ==============================================




        $paymentmode = $this->paymentmodel->findAll();
        $properties = $this->propertymodel->getPropertiesWithOneImage();
        $services = $this->servicemodel->getservice();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "leads" => $leads,
            "properties" => $properties,
            "services" => $services,
            "customer_id" => $customer_id,
            "paymentmode" => $paymentmode,
        ];

        return $this->renderView('leads/convertion', $data);
    }

    public function save_conversion()
    {
        helper(['form', 'url']);

        $db = \Config\Database::connect();
        $builder = $db->table('property_transactions');

        // Get POST data
        $data = [
            'customer_id'           => $this->request->getPost('customer_id'),
            // 'customer_name'     => $this->request->getPost('customer_name'), // Optional if needed
            // 'mobile'            => $this->request->getPost('mobile'),
            // 'email'             => $this->request->getPost('email'),

            'transaction_mode'  => $this->request->getPost('transaction_mode'),
            'payment_mode'      => $this->request->getPost('payment_mode'),
            'amount_paid'       => $this->request->getPost('amount_paid'),
            'transaction_date'  => $this->request->getPost('transaction_date'),
            'receipt_number'    => $this->request->getPost('receipt_number'),
            'property_id'       => '',
            'property_name'     => '',
            'property_type'     => '',
            'property_price'    => 0.00,
        ];

        // Handle selected item (property or service)
        $itemType = $this->request->getPost('item_type');
        $itemId = $this->request->getPost('item_id');
        $data['item_type'] = $itemType;
        $pname = "";
        if ($itemType === 'property') {
            $property = $db->table('properties')->where('id', $itemId)->get()->getRow();
            if ($property) {
                $pname = $property->title;
                $data['property_id'] = $itemId;
                $data['property_name'] = $property->title;
                $data['property_type'] = $property->category;
                $data['property_price'] = $property->price;
            }
        } elseif ($itemType === 'service') {
            $service = $db->table('services')->where('id', $itemId)->get()->getRow();
            if ($service) {
                $pname = $service->title;
                $data['property_id'] = $itemId;
                $data['property_name'] = $service->title;
                $data['property_type'] = $service->category;
                $data['property_price'] = $service->price;
            }
        }

        // Handle receipt file upload
        $file = $this->request->getFile('receipt_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            // $file->move('uploads/receipts', $newName);
            $file->move(FCPATH . 'public\uploads\receipts', $newName);
            $data['receipt_file_path'] = 'uploads/receipts/' . $newName;
        }
        log_message('info', 'details: ' . print_r($data, true));

        // Insert data
        $builder->insert($data);

        // ======================================
        if ($itemType === 'property') {
            $accheadid = "3";
            $desp = "Property Sale";
        } else {
            $accheadid = "8";
            $desp = "Service Income";
        }

        $headdata = [
            'date'   => $this->request->getPost('transaction_date'),
            'account_head_id'   =>  $accheadid,
            'description' => $desp,
            'transaction_type'   => 'income',
            'amount'   => $this->request->getPost('amount_paid'),
            'mode_id'   => $this->request->getPost('transaction_mode'),
            'reference_no'   =>  $this->request->getPost('receipt_number'),
            'created_by'   => 'Consignus',
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $this->transmodel->insert($headdata);

        $cid =   $this->request->getPost('customer_id');

        $cdata = [
            'property_booked' => $pname,
            'booking_date' =>  $this->request->getPost('transaction_date'),
            'payment_status' =>   $this->request->getPost('payment_mode'),
            'amount_paid' => $this->request->getPost('amount_paid'),
            'modified_at' => date('Y-m-d h:i:s'),
            'propertyid' => $itemId

        ];
        $this->custmodel->updateCustomer($cid, $cdata);


        // =================================================

        return redirect()->to('/customers')->with('message', 'Conversion saved successfully!');
    }
}
