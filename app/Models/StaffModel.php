<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table            = 'staff';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'full_name',
        'username',
        'email',
        'phone',
        'address',
        'role',
        'department',
        'status',
        'profile_pic',
        'date_joined',
        'password_hash',
        'last_login',
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

    public function getStaff($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }
    public function getstaffcomuserdata($id)
    {
        $builder = $this->db->table('staff');
        $builder->select('staff.*, users.id as uid, users.cmded');
        $builder->join('users', 'users.empid = staff.id', 'left');
        $builder->where('staff.id', $id);

        $query = $builder->get();
        return $query->getRowArray(); // or getResultArray() for multiple rows
    }

    public function updateStaff($id, array $data)
    {
        return $this->update($id, $data);
    }
    public function deleteStaff($id)
    {
        return $this->delete($id);
    }
    public function createStaff(array $data)
    {
        return $this->insert($data);
    }
}
