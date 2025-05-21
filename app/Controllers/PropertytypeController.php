<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PropertytypeModel;

class PropertytypeController extends BaseController
{
    public $ptypemodel;
    public function __construct(){
        $this->ptypemodel = new PropertytypeModel();
    }
    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $properties = $this->ptypemodel->getpropertytype();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "properties" => $properties,
        ];

        // $this->logData('info', 'property idaa array', $data);
        return $this->renderView('propertytype/propertytypeview', $data);
    }

    public function addpropertytype()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
        ];

        return $this->renderView('propertytype/addpropertytype', $data);
    }

    public function savepropertytype()
    {

        helper(['form']);
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "ptitle" => "required",
            "pcategory" => "required",
            "balconies" => "required",
            "sarea"  => "required",
            "carea" => "required",
            "bedroom" => "required",
            "pstatus" => "required",
            "featured" => "required",
        ]);

        // Initialize data with page details
        $data = [
            "validation" => null, // Default null, will be set if validation fails
        ];




        $cdata = [
            'name' => $this->request->getVar('ptitle'),
            'category' => $this->request->getVar('pcategory'),
            'bedrooms' =>  $this->request->getVar('bedroom'),
            'bathrooms' => $this->request->getVar('bathroom'),
            'balconies' => $this->request->getVar('balconies'),
            'super_builtup_area' => $this->request->getVar('sarea') ,
            'carpet_area' => $this->request->getVar('carea'),
            'description' =>  $this->request->getVar('editor_content'),
            'status' => $this->request->getVar('pstatus'),
            'created_at' => date('Y-m-d h:i:s'),

        ];
        $this->logData('info', 'propertytype  Data array', $cdata);

        $this->ptypemodel->savepropertytype($cdata);

        return redirect()->to('/property-type');
    }


    public function editpropertytype($pid)
    {
        $property = $this->ptypemodel->getpropertytype($pid);
        

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "propertytype" => $property,
           
        ];
        // $this->logData('info', 'property data array', $data);
        return $this->renderView('propertytype/editpropertytype', $data);
    }

    public function updatepropertytype()
    {

        $ppropertyid = $this->request->getVar('pid');
 
        $cdata = [
            'name' => $this->request->getVar('ptitle'),
            'category' => $this->request->getVar('pcategory'),
            'bedrooms' =>  $this->request->getVar('bedroom'),
            'bathrooms' => $this->request->getVar('bathroom'),
            'balconies' => $this->request->getVar('balconies'),
            'super_builtup_area' => $this->request->getVar('sarea') ,
            'carpet_area' => $this->request->getVar('carea'),
            'description' =>  $this->request->getVar('editor_content'),
            'status' => $this->request->getVar('pstatus'),
            'updated_at' => date('Y-m-d h:i:s'),
        ];
        $this->ptypemodel->updatepropertytype($ppropertyid, $cdata);

      


        return redirect()->to('property-type');

    }

    public function deletepropertytype($aid){
        $result =$this->ptypemodel->deletepropertytype($aid);
        if ($result){
            
            return redirect()->to('/property-type');
        }
    }
}
