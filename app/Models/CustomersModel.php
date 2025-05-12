<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table            = 'customers';
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


    public function getCustomer($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }
    public function createCustomer($data)
    {
        return $this->insert($data);
    }
    public function updateCustomer($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteCustomer($id)
    {
        return $this->delete($id);
    }

    public function getCustomerRegistrationsLast6Monthsold()
    {
        $builder = $this->db->table('customers');
        $builder->select("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count");
        $builder->where('created_at >=', date('Y-m-01', strtotime('-5 months')));
        $builder->groupBy('month');
        $builder->orderBy('month', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function getCustomerRegistrationsLast6Months()
    {
        $result = [];

        // Prepare an array for the last 6 months with 0 as default
        for ($i = 5; $i >= 0; $i--) {
            $monthKey = date('M', strtotime("-$i months"));
            $result[$monthKey] = 0;
        }

        // Fetch actual data
        $builder = $this->db->table('customers');
        $builder->select("DATE_FORMAT(created_at, '%b') as month, COUNT(*) as count");
        $builder->where('created_at >=', date('Y-m-01', strtotime('-5 months')));
        $builder->groupBy('month');
        $query = $builder->get()->getResultArray();

        // Merge actual data into result
        foreach ($query as $row) {
            $result[$row['month']] = (int)$row['count'];
        }

        return $result;
    }
}
