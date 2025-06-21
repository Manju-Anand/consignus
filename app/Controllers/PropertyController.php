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
        return $this->renderView('property/propertyview', $data);
    }

    public function propertylistview()
    {

        // if (!$this->session->has('logged_user')) {

        //     return view('loginview');
        // }
        $ptypes = $this->propertymodel->getPropertyWithDetails();
        $data = [
            "meta_title" => "Consignus",
            "meta_description" => "Consignus",
            "ptype" => $ptypes,
        ];
        $this->logData('info', 'property idaa array', $data);
        return $this->renderView('property/propertyexport', $data);
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
            'ownerno' => $this->request->getVar('ownerno'),
            'property_listing' => $this->request->getVar('plisting'),
            'property_verify' => $this->request->getVar('pverify'),

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
        // if ($files) {
        //     foreach ($files as $file) {
        //         if ($file->isValid() && !$file->hasMoved()) {
        //             $resizedName = $this->processImage($file); // 👈 Process each image

        //             $imagedata = [
        //                 'property_id' => $property_id,
        //                 'image_path' => $resizedName,
        //                 'created_at' => date('Y-m-d h:i:s'),
        //             ];

        //             $this->logData('info', 'property imagedata array', $imagedata);
        //             $this->pimagesmodel->insert($imagedata);
        //         }
        //     }
        // }


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
        $this->logData('info', 'property data array', $id);
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
            'ownerno' => $this->request->getVar('ownerno'),
            'property_listing' => $this->request->getVar('plisting'),
            'property_verify' => $this->request->getVar('pverify'),
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

    // ******************* this function is used to crop image to a specific dimension while uploading **************************
    private function processImage($file, $targetWidth = 720, $targetHeight = 520)
    {
        $image = \Config\Services::image();
        $newName = $file->getRandomName();
        $originalPath = FCPATH . 'public/uploads/property/original_' . $newName;
        $finalPath = FCPATH . 'public/uploads/property/final_' . $newName;

        // Move original
        $file->move(FCPATH . 'public/uploads/property/', 'original_' . $newName);

        // Get original dimensions
        $imageSize = getimagesize($originalPath);
        $width = $imageSize[0];
        $height = $imageSize[1];
        $srcRatio = $width / $height;
        $targetRatio = $targetWidth / $targetHeight;

        // Determine how to crop
        if ($srcRatio > $targetRatio) {
            // Source is wider
            $newHeight = $height;
            $newWidth = $height * $targetRatio;
            $x = ($width - $newWidth) / 2;
            $y = 0;
        } else {
            // Source is taller or same
            $newWidth = $width;
            $newHeight = $width / $targetRatio;
            $x = 0;
            $y = ($height - $newHeight) / 2;
        }

        // Crop and resize
        $image->withFile($originalPath)
            ->crop((int)$newWidth, (int)$newHeight, (int)$x, (int)$y)
            ->resize($targetWidth, $targetHeight, true)
            ->save($finalPath);

        // Delete the original if not needed
        @unlink($originalPath);

        return 'final_' . $newName;
    }




    // ********************* the below 2 functions to resize the pictures in a folder to a specific dimension altogether********************
    public function resizeAllPropertyImages()
    {
        helper('filesystem');
        $db = \Config\Database::connect();
        $builder = $db->table('property_images');
        $images = $builder->get()->getResult();

        $targetWidth = 720;
        $targetHeight = 520;
        $uploadPath = FCPATH . 'public/uploads/property/';
        $backupPath = FCPATH . 'public/uploads/property_backup/';

        // Create backup folder if it doesn't exist
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        foreach ($images as $img) {
            $imagePath = $uploadPath . $img->image_path;
            $backupImagePath = $backupPath . $img->image_path;

            if (file_exists($imagePath)) {
                // Backup original image
                if (!file_exists($backupImagePath)) {
                    copy($imagePath, $backupImagePath);
                }

                // Resize & crop
                $this->resizeAndCropImage($imagePath, $targetWidth, $targetHeight);
            } else {
                log_message('error', 'Image not found: ' . $imagePath);
            }
        }

        echo "All property images resized to {$targetWidth}x{$targetHeight} successfully. Originals backed up.";
    }

    private function resizeAndCropImage($imagePath, $targetWidth, $targetHeight)
    {
        $image = \Config\Services::image()
            ->withFile($imagePath)
            ->resize($targetWidth, $targetHeight, true, 'height')
            ->crop($targetWidth, $targetHeight, 0, 0)
            ->save($imagePath); // overwrite original
    }

    // ************************ change old folder to new folder ***************************

    public function swapPropertyFolders()
    {
        $basePath = FCPATH . 'public/uploads/';
        $propertyPath     = $basePath . 'property/';
        $backupPath       = $basePath . 'property_backup/';

        // Generate timestamped backup name: property_YYYYMMDD_HHMM_old
        $timestamp = date('Ymd_Hi'); // e.g., 20240607_1025
        $propertyOldPath = $basePath . 'property_' . $timestamp . '_old/';

        // Check if original 'property' exists
        if (!is_dir($propertyPath)) {
            return $this->response->setBody("❌ Error: 'property' folder does not exist.");
        }

        // Step 1: Rename 'property' to timestamped backup folder
        if (!rename($propertyPath, $propertyOldPath)) {
            return $this->response->setBody("❌ Error renaming 'property' to '$propertyOldPath'.");
        }

        // Step 2: Rename 'property_backup' to 'property'
        if (!is_dir($backupPath)) {
            return $this->response->setBody("❌ Error: 'property_backup' folder does not exist.");
        }

        if (!rename($backupPath, $propertyPath)) {
            return $this->response->setBody("❌ Error renaming 'property_backup' to 'property'.");
        }

        return $this->response->setBody("✅ Success: Folders swapped.<br>'property' → '$propertyOldPath'<br>'property_backup' → 'property'");
    }
}
