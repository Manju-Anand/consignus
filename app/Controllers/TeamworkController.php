<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TeamassignmentModel;
use App\Models\TeamworkModel;


class TeamworkController extends BaseController
{
    public $teamssignmodel;
    public $teamupdatemodel;
 
    public function __construct()
    {
        $this->teamssignmodel = new TeamassignmentModel();
        $this->teamupdatemodel = new TeamworkModel();
       
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
      
        $teamassign = $this->teamupdatemodel->getteamworkupdates();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            
            "teamassign" => $teamassign,
        ];
        $this->logData('info', 'Data array', $data);
        return $this->renderView('lbm/teamworkupdateview', $data);
    }
}
