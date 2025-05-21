<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertytypeModel extends Model
{
    protected $table            = 'property_types';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'name',
        'category',
        'bedrooms',
        'bathrooms',
        'balconies',
        'super_builtup_area',
        'carpet_area',
        'description',
        'status',
        'created_at',
        'updated_at'
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

    public function getpropertytype($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }

    public function savepropertytype($data)
    {
        return $this->insert($data);
    }
    public function updatepropertytype($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deletepropertytype($id)
    {
        return $this->delete($id);
    }
}
