<?php

namespace App\Models;

use CodeIgniter\Model;

class LbmModel extends Model
{
    protected $table            = 'leadership_board_members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'name',
        'business_name',
        'contact_number',
        'email',
        'address',
        'profile_image',
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

    public function getLbm($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }
    public function savelbm($data)
    {
        return $this->insert($data);
    }
    public function updatelbm($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deletelbm($id)
    {
        return $this->delete($id);
    }

    public function getlbmcomuserdata($id)
    {
        $builder = $this->db->table('leadership_board_members');
        $builder->select('leadership_board_members.*, users.id as uid,users.username as uname, users.cmded');
        $builder->join('users', 'users.lbmid = leadership_board_members.id', 'left');
        $builder->where('leadership_board_members.id', $id);

        $query = $builder->get();
        return $query->getRowArray(); // or getResultArray() for multiple rows
    }
    public function getteamassigndata()
    {
        $builder = $this->db->table('team_assignments');
        $builder->select('team_assignments.*,leadership_board_members.name as lname,customers.name as cname,properties.title');
        $builder->join('customers', 'customers.id = team_assignments.customer_id', 'left');
        $builder->join('leadership_board_members', 'leadership_board_members.id = team_assignments.member_id', 'left');
        $builder->join('properties', 'properties.id = team_assignments.property_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getCoreTeamStats()
    {
        $builder = $this->db->table('leadership_board_members lbm');
        $builder->select('lbm.id, lbm.name, lbm.business_name, lbm.contact_number, lbm.email, lbm.address, lbm.profile_image, ta.role, COUNT(DISTINCT ta.customer_id) AS customers_handled');
        $builder->join('team_assignments ta', 'ta.member_id = lbm.id', 'left');
        $builder->groupBy('lbm.id, ta.role');

        return $builder->get()->getResultArray();
    }
}
