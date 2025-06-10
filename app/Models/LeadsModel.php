<?php

namespace App\Models;

use CodeIgniter\Model;

class LeadsModel extends Model
{
    protected $table            = 'leads';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'name',
        'phone',
        'email',
        'address',
        'requirement_type',
        'budget_range',
        'preferred_location',
        'lead_source',
        'enquiry_date',
        'assigned_staff_id',
        'created_at',
        'leadstatus',
        'agentid',
        'lead_purpose',
        'referername'
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

    public function getleads($id = null)
    {
        $builder = $this->db->table('leads');
        $builder->select('leads.*,staff.full_name as sname,agents.name as agentname');
        $builder->join('staff', 'staff.id = leads.assigned_staff_id', 'left');
        $builder->join('agents', 'agents.id = leads.agentid', 'left');
        if ($id) {
            $builder->where('leads.id', $id);
            $query = $builder->get();
            return $query->getRowArray(); // returns a single associative array
        } else {
            $query = $builder->get();
            return $query->getResultArray(); // returns multiple records
        }
    }
}
