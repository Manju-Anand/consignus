<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'username',
        'password',
        'email',
        'designation',
        'empid',
        'cmded',
        'lbmid'
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


    public function verifyemail($email)
    {

        $bulider = $this->db->table("users");
        $bulider->select('email,password,id,lbmid');
        $bulider->where("email", $email);
        $result = $bulider->get();
        if ($bulider->countAll()) {
            return $result->getRow();
        } else {
            return false;
        }
    }
    public function saveLoginInfo($data)
    {
        $builder = $this->db->table("loginactivity");
        $builder->insert($data);
        if ($this->db->affectedRows() == 1) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function saveuserData($data)
    {
        $db = \Config\Database::connect();

        // Start transaction to ensure both insertions are successful
        $db->transStart();

        // Insert into students_users table first
        $usersTable = $db->table('users');
        $userData = [
            'username'          => $data['username'],
            'password'          => $data['password'], // Already hashed in controller
            'email'             => $data['email'],
            'designation'    => "Admin", // Default value, you can change it as needed
            'empid'           => "1",
            'cmded'          => $data['orgpd'],

        ];

        $usersTable->insert($userData);
        $userId = $db->insertID(); // Get last inserted ID

        if (!$userId) {
            $db->transRollback(); // Rollback if user insert fails
            return false;
        }


        // Commit transaction if both inserts are successful
        $db->transComplete();

        // return $db->transStatus(); // Returns true if successful
        return [
            'transaction_status' => $db->transStatus(),
            'user_id' => $userId,

        ];
    }
}
