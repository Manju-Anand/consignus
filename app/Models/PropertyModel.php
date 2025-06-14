<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table            = 'properties';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'title',
        'category',
        'purpose',
        'price',
        'location',
        'size_area',
        'bedrooms',
        'bathrooms',
        'description',
        'status',
        'is_featured',
        'created_at',
        'propertytype_id',
        'no_of_property',
        'ownerno',
        'property_listing',
        'property_verify'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getproperty($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }
    public function getPropertiesWithImages($id = null)
    {
        if ($id == null) {
            return $this->db->table('properties p')
                ->select('p.*, i.image_path')
                ->join('property_images i', 'i.property_id = p.id', 'left')
                ->get()
                ->getResult();
        } else {
            return $this->db->table('properties p')
                ->select('p.*, i.image_path')
                ->join('property_images i', 'i.property_id = p.id', 'left')
                ->where('p.id', $id)
                ->get()
                ->getResult();
        }
    }
    public function getPropertiesWithOneImage()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('properties p')
            ->select(
                'p.*, 
            (SELECT image_path FROM property_images i 
             WHERE i.property_id = p.id 
             ORDER BY i.id ASC LIMIT 1) as image_path'
            );

        return $builder->get()->getResultArray();
    }
    public function getPropertyWithTypeDetails($propertyId)
    {
        $db = \Config\Database::connect();

        return $db->table('properties p')
            ->select('p.*, py.*,py.description as pydesp,p.description as prodesp')
            ->join('property_types py', 'py.id = p.propertytype_id', 'left')
            ->where('p.id', $propertyId)
            ->get()
            ->getRow(); // Use getRow() for single result
    }
    public function getPropertyWithDetails()
    {
        $db = \Config\Database::connect();

        return $db->table('properties p')
            ->select('p.*, py.*,p.category as orgcategory, py.description as pydesp, p.description as prodesp')
            ->join('property_types py', 'py.id = p.propertytype_id', 'left')
            ->get()
            ->getResult(); // Use getResult() for multiple records
    }



    public function saveproperty($data)
    {
        return $this->insert($data);
    }
    public function updateproperty($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteproperty($id)
    {
        return $this->delete($id);
    }


    public function getPropertyTypeDistribution()
    {
        return $this->db->table('properties')
            ->select('category, COUNT(*) as count')
            ->groupBy('category')
            ->get()
            ->getResultArray();
    }

    public function getPropertiesListedPerMonth()
    {
        $builder = $this->db->table('properties');
        $builder->select("DATE_FORMAT(created_at, '%b %Y') AS month, COUNT(*) AS count");
        $builder->where('created_at >=', date('Y-m-01', strtotime('-5 months'))); // Start from 6 months ago
        $builder->groupBy("month");
        $builder->orderBy("created_at", 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
