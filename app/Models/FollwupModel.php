<?php

namespace App\Models;

use CodeIgniter\Model;

class FollwupModel extends Model
{
    protected $table            = 'follow_ups';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'customer_id',
        'follow_up_date',
        'next_follow_up_date',
        'communication_mode',
        'notes',
        'status',
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

    public function getfollowup($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }
    public function getfollowupwithcid($cid)
    {
        return $this->db->table('follow_ups')
            ->where('customer_id', $cid)
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function createFollowup($data)
    {
        return $this->insert($data);
    }
    public function updateFollowup($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteFollowup($id)
    {
        return $this->delete($id);
    }
}
