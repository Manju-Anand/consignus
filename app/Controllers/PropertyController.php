<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PropertyModel;
use App\Models\PropertimagesModel;
use App\Models\PropertytypeModel;

class PropertyController extends BaseController
{
    public $propertymodel;
    public $pimagesmodel;
    public $ptypemodel;
    public function __construct()
    {
        $this->propertymodel = new PropertyModel();
        $this->pimagesmodel = new PropertimagesModel();
        $this->ptypemodel = new PropertytypeModel();
    }

    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $properties = $this->propertymodel->getPropertiesWithOneImage();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "properties" => $properties,
        ];

        // $this->logData('info', 'property idaa array', $data);
        return $this->renderView('property/propertyview', $data);
    }


    public function addproperty()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $ptypes = $this->ptypemodel->getpropertytype();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "ptype" => $ptypes,
        ];

        return $this->renderView('property/addproperty', $data);
    }

    public function saveproperty()
    {

        helper(['form']);
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            "ptitle" => "required",
            "pcategory" => "required",
            "purpose" => "required",
            "price"  => "required",
            "location" => "required",
            "pstatus" => "required",
            "featured" => "required",
            "ptype" => "required",
            "propertyno" => "required",
        ]);

        // Initialize data with page details
        $data = [
            "validation" => null, // Default null, will be set if validation fails
        ];




        $cdata = [
            'title' => $this->request->getVar('ptitle'),
            'category' => $this->request->getVar('pcategory'),
            'purpose' =>  $this->request->getVar('purpose'),
            'price' => $this->request->getVar('price'),
            'location' => $this->request->getVar('location'),
            'propertytype_id' => $this->request->getVar('ptype'),
            'description' =>  $this->request->getVar('editor_content'),
            'status' => $this->request->getVar('pstatus'),
            'is_featured' => $this->request->getVar('featured'),
            'created_at' => date('Y-m-d h:i:s'),
            'no_of_property' => $this->request->getVar('propertyno'),

        ];
        $this->logData('info', 'property Data array', $cdata);

        $property_id =  $this->propertymodel->saveproperty($cdata);
        // dd($this->request->getFileMultiple('upload-file-multiple'));

        $files = $this->request->getFileMultiple('upload-file-multiple');

        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'public/uploads/property/', $newName);

                    $imagedata = [
                        'property_id' => $property_id,
                        'image_path' => $newName,
                        'created_at' => date('Y-m-d h:i:s'),
                    ];
                    $this->logData('info', 'property imagedata array', $imagedata);
                    $this->pimagesmodel->insert($imagedata);
                }
            }
        }


        return redirect()->to('property');
    }


    public function editproperty($pid)
    {
        $property = $this->propertymodel->getproperty($pid);
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
        return $this->renderView('property/editproperty', $data);
    }


    public function deleteImage($id)
    {

        $image =  $this->pimagesmodel->find($id);

        if ($image) {
            $filePath = FCPATH . 'public/uploads/property/' . $image['image_path'];

            // Delete from database
            $this->pimagesmodel->delete($id);

            // Unlink the file if it exists
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return redirect()->back()->with('success', 'Image deleted successfully.');
        }

        return redirect()->back()->with('error', 'Image not found.');
    }


    public function updateproperty()
    {

        $ppropertyid = $this->request->getVar('pid');

        $cdata = [
            'title' => $this->request->getVar('ptitle'),
            'category' => $this->request->getVar('pcategory'),
            'purpose' =>  $this->request->getVar('purpose'),
            'price' => $this->request->getVar('price'),
            'location' => $this->request->getVar('location'),
            'propertytype_id' => $this->request->getVar('ptype'),
            'description' =>  $this->request->getVar('editor_content'),
            'status' => $this->request->getVar('pstatus'),
            'is_featured' => $this->request->getVar('featured'),
            'created_at' => date('Y-m-d h:i:s'),
            'no_of_property' => $this->request->getVar('propertyno'),
        ];
        $this->propertymodel->updateproperty($ppropertyid, $cdata);

        $files = $this->request->getFileMultiple('upload-file-multiple');

        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'public/uploads/property/', $newName);

                    $imagedata = [
                        'property_id' => $ppropertyid,
                        'image_path' => $newName,
                        'created_at' => date('Y-m-d h:i:s'),
                    ];
                    $this->logData('info', 'property imagedata array', $imagedata);
                    $this->pimagesmodel->insert($imagedata);
                }
            }
        }


        return redirect()->to('property');
    }


    public function deleteproperty($aid)
    {
        $result = $this->propertymodel->deleteproperty($aid);
        if ($result) {

            return redirect()->to('/property');
        }
    }


    public function getPropertyDetails()
    {
        $id = $this->request->getPost('id');

        $property = $this->ptypemodel->find($id);

        if ($property) {
            return view('property/property_detail_table', ['property' => $property]);
        } else {
            return 'No details found.';
        }
    }

    public function viewproperty($pid)
    {
        $property = $this->propertymodel->getproperty($pid);
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
        return $this->renderView('property/viewproperty', $data);
    }
}
