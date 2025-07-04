<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchitectModel extends Model
{
    protected $table            = 'architects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'name',
        'email',
        'phone',
        'role',
        'created_at'
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

    public function getArchitects()
    {
        return $this->findAll();
    }

    public function getArchitect($id)
    {
        return $this->find($id);
    }

    public function createarchitect($data)
    {
        return $this->insert($data);
    }

    public function updatearchitect($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletearchitect($id)
    {
        return $this->delete($id);
    }
}
