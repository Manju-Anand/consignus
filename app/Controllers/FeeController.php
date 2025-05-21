<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FeeModel;
use App\Models\StageModel;

class FeeController extends BaseController

{

    public $feemodel;
    public $stagemodel;
    public function __construct()
    {
        $this->feemodel = new FeeModel();
        $this->stagemodel = new StageModel();
    }


    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }


        $feelist = $this->feemodel->getfeebyStagedetails();
        $stages = $this->stagemodel->getStages();


        $data = [
            "meta_title" => "ArchFlow - Smart CRM Software for Architecture Firms",
            "meta_description" => "ArchFlow is a powerful CRM software designed for architecture firms to manage enquiries, site visits, quotations, 3D plans, revisions, and payments efficiently. Streamline your workflow with ArchFlow today!",
            "feelist" => $feelist,
            "stageslist" => $stages,
            "editstageslist" => $stages,
        ];

        $this->logData('info', 'fees Data array', $data);
        return $this->renderView('fees/feesview', $data);
    }

    public function saveTask()
    {

        // Get data from the request
        $data = [
            'stage_id' => $this->request->getPost('stageid'),
            'feeName' => $this->request->getPost('fname'),
            'feeAmount' => $this->request->getPost('feeamt'),
            'created' => date('Y-m-d H:i:s'),
        ];


        // Insert data into the database
        if ($this->feemodel->addFees($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Fees saved successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save task']);
        }
    }

    public function updateFees()
    {


        $id = $this->request->getPost('id');
        $data = [
            'feeName' => $this->request->getPost('feesname'),
            'feeAmount' => $this->request->getPost('feesamt'),
            'id' => $this->request->getPost('id'),
            'stage_id' => $this->request->getPost('stageid'),
            'modified' => date('Y-m-d H:i:s'),

        ];

        $this->logData('info', 'Fees Data array', $data);

        if ($id) {
            $this->feemodel->updateFees($id, $data);
        }

        return $this->response->setJSON(['success' => true]);
    }

    public function deleteFees($aid){
        $result =$this->feemodel->deleteFees($aid);
        if ($result){
            return redirect()->to('/fees');
        }
    }
}
