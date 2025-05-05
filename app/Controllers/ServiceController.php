<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ServiceModel;
use App\Models\ServiceimagesModel;

class ServiceController extends BaseController
{
    public $servicemodel;
    public $serviceimages;
    public function __construct()
    {
        $this->servicemodel = new ServiceModel();
        $this->serviceimages = new ServiceimagesModel();
    }


    public function index()
    {
        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }
        $services = $this->servicemodel->getservice();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "services" => $services,
        ];

        // $this->logData('info', 'services idaa array', $data);
        return $this->renderView('services/serviceview', $data);
    }

    public function addservice()
    {

        if (!$this->session->has('logged_user')) {

            return view('loginview');
        }

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
        ];

        return $this->renderView('services/addservice', $data);
    }

    public function saveservice()
    {

        helper(['form']);

        $cdata = [
            'title' => $this->request->getVar('stitle'),
            'category' => $this->request->getVar('scategory'),
            'price' => $this->request->getVar('price'),
            'description' =>  $this->request->getVar('editor_content'),
            'status' => $this->request->getVar('sstatus'),
            'is_featured' => $this->request->getVar('featured'),
            'created_at' => date('Y-m-d h:i:s'),

        ];
        $this->logData('info', 'services Data array', $cdata);

        $property_id =  $this->servicemodel->saveservice($cdata);
        // dd($this->request->getFileMultiple('upload-file-multiple'));

        $files = $this->request->getFileMultiple('upload-file-multiple');

        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'public/uploads/services/', $newName);

                    $imagedata = [
                        'service_id' => $property_id,
                        'image_path' => $newName,
                        'created_at' => date('Y-m-d h:i:s'),
                    ];
                    $this->logData('info', 'services imagedata array', $imagedata);
                    $this->serviceimages->insert($imagedata);
                }
            }
        }


        return redirect()->to('services');
    }

    public function editservice($pid)
    {
        $service = $this->servicemodel->getservice($pid);
        $serviceimages = $this->serviceimages->getserviceimages($pid);

        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "service" => $service,
            "serviceimages" => $serviceimages
        ];

        $this->logData('info', 'serviceimages data array', $data);
        return $this->renderView('services/editservices', $data);
    }


    public function deleteserviceImage($id)
    {

        $image =  $this->serviceimages->find($id);

        if ($image) {
            $filePath = FCPATH . 'public/uploads/services/' . $image['image_path'];

            // Delete from database
            $this->serviceimages->delete($id);

            // Unlink the file if it exists
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return redirect()->back()->with('success', 'Image deleted successfully.');
        }

        return redirect()->back()->with('error', 'Image not found.');
    }


    public function updateservice()
    {

        $serviceid = $this->request->getVar('pid');

        $cdata = [
            'title' => $this->request->getVar('ptitle'),
            'category' => $this->request->getVar('pcategory'),
            'price' => $this->request->getVar('price'),
            'description' =>  $this->request->getVar('editor_content'),
            'status' => $this->request->getVar('pstatus'),
            'is_featured' => $this->request->getVar('featured'),
            'created_at' => date('Y-m-d h:i:s'),
        ];
        $this->servicemodel->updateproperty($serviceid, $cdata);

        $files = $this->request->getFileMultiple('upload-file-multiple');

        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'public/uploads/services/', $newName);

                    $imagedata = [
                        'service_id' => $serviceid,
                        'image_path' => $newName,
                        'created_at' => date('Y-m-d h:i:s'),
                    ];
                    $this->logData('info', 'services imagedata array', $imagedata);
                    $this->serviceimages->insert($imagedata);
                }
            }
        }


        return redirect()->to('services');
    }


    public function deleteservice($aid)
    {
        $result = $this->servicemodel->deleteservice($aid);
        if ($result) {

            return redirect()->to('/services');
        }
    }
}
