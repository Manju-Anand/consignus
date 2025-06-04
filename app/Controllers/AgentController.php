<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AgentModel;

class AgentController extends BaseController
{
    public $agentmodel;
    public function __construct()
    {
        $this->agentmodel = new AgentModel();
    }

    public function index()
    {
        $agents = $this->agentmodel->findAll();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "agents" => $agents,
        ];

        return $this->renderView('agents/agentview', $data);
    }

    public function addagent()
    {

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
        ];

        return $this->renderView('agents/addagent', $data);
    }

    public function saveagent()
    {
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "aname" => "required",
            "aphone" => "required|numeric|min_length[10]|max_length[15]",

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

            return $this->renderView('agents/addagent', $data);
        } else {


            $cdata = [
                'name' => $this->request->getVar('aname'),
                'phoneno' => $this->request->getVar('aphone'),
                'address' => $this->request->getVar('addr'),
                'created' => date('Y-m-d h:i:s'),

            ];

            $agent_id = $this->agentmodel->insert($cdata);

            return redirect()->to('/agents');
        }
    }

    public function editagents($pid)
    {
        $agent = $this->agentmodel->find($pid);
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "agent" => $agent,

        ];
        return $this->renderView('agents/editagent', $data);
    }

    public function updateagents()
    {


        $agentid = $this->request->getVar('aid');


        $cdata = [
            'name' => $this->request->getVar('aname'),
            'phoneno' => $this->request->getVar('aphone'),
            'address' => $this->request->getVar('addr'),
            'modified' => date('Y-m-d h:i:s'),

        ];
        $this->agentmodel->update($agentid, $cdata);




        return redirect()->to('/agents');
    }

    public function deletesagents($aid)
    {
        $result = $this->agentmodel->delete($aid);
        if ($result) {
            return redirect()->to('/agents');
        }
    }
}
