<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamworkModel extends Model
{
    protected $table            = 'team_work_updates';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'assignment_id',
        'work_notes',
        'attachments',
        'status',
        'submitted_at',
        'perinvolvement',
        'remuneration'
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

    public function getteamworkupdates()
    {
        $builder = $this->db->table('team_assignments');
        $builder->select('team_assignments.*,team_assignments.status as orgstatus,leadership_board_members.name as lname,
        customers.name as cname,properties.title');
        // ,team_work_updates.*,team_work_updates.id as updateid
        $builder->join('customers', 'customers.id = team_assignments.customer_id', 'left');
        $builder->join('leadership_board_members', 'leadership_board_members.id = team_assignments.member_id', 'left');
        $builder->join('properties', 'properties.id = team_assignments.property_id', 'left');
        // $builder->join('team_work_updates','team_work_updates.assignment_id  = team_assignments.id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getteamworkupdateswithid($id)
    {
        $builder = $this->db->table('team_assignments');
        $builder->select('team_assignments.*, team_assignments.status as orgstatus, 
                      leadership_board_members.name as lname, 
                      customers.name as cname, 
                      properties.title');

        $builder->join('customers', 'customers.id = team_assignments.customer_id', 'left');
        $builder->join('leadership_board_members', 'leadership_board_members.id = team_assignments.member_id', 'left');
        $builder->join('properties', 'properties.id = team_assignments.property_id', 'left');

        $builder->where('team_assignments.id', $id);

        $query = $builder->get();
        return $query->getRowArray(); // fetches only one record as an associative array
    }
    public function getlbmcontribution()
    {
        $builder = $this->db->table('team_assignments');
        $builder->select('team_assignments.*, team_assignments.status as orgstatus, 
                      leadership_board_members.name as lname, 
                      customers.name as cname, 
                      properties.title,team_work_updates.*');

        $builder->join('customers', 'customers.id = team_assignments.customer_id', 'left');
        $builder->join('leadership_board_members', 'leadership_board_members.id = team_assignments.member_id', 'left');
        $builder->join('properties', 'properties.id = team_assignments.property_id', 'left');
        $builder->join('team_work_updates', 'team_work_updates.assignment_id  = team_assignments.id', 'left');


        $query = $builder->get();
        return $query->getResultArray();
        // fetches only one record as an associative array
    }


    public function companyLiabilityList()
    {
        $builder = $this->db->table('team_assignments ta');
        $builder->select('
        ta.id as assignment_id,
        ta.member_id,
        ta.customer_id,
        ta.property_id,
        ta.role,
        ta.status as assignment_status,
        twu.id as twu_id,
        twu.perinvolvement,
        twu.remuneration,
        twu.status as work_status,
        twu.submitted_at as remuneration_date,
        sve.amount as expense_amount,
        sve.expense_type,
        sve.expense_date,
        sve.paidStatus as expense_status,
        leadership_board_members.name as lname, 
        customers.name as cname, 
        properties.title
    ');

        $builder->join('team_work_updates twu', 'twu.assignment_id = ta.id', 'left');
        $builder->join('site_visit_expenses sve', 'sve.twu_id = twu.id', 'left');
        $builder->join('customers', 'customers.id = ta.customer_id', 'left');
        $builder->join('leadership_board_members', 'leadership_board_members.id = ta.member_id', 'left');
        $builder->join('properties', 'properties.id = ta.property_id', 'left');

        // Add liability condition
        $builder->groupStart();
        $builder->where('twu.status !=', 'completed');
        $builder->orWhere('sve.paidStatus !=', 'paid');
        $builder->groupEnd();

        $query = $builder->get();
        return $query->getResultArray();
    }
}
