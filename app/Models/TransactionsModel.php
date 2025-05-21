<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionsModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'date',
        'account_head_id',
        'description',
        'transaction_type',
        'amount',
        'mode_id',
        'reference_no',
        'created_by',
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

    public function gettransactions(){

        $builder =$this->db->table('transactions');
        $builder->select('transactions.*,account_heads.head_name as headname,payment_modes.mode_name as modename');
        $builder->join('account_heads','account_heads.id = transactions.account_head_id', 'left');
        $builder->join('payment_modes','payment_modes.id = transactions.mode_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();


    }

    public function getIncomeExpenditureSummary($startDate = null, $endDate = null)
    {
        $builder = $this->select('transaction_type, SUM(amount) as total');

        if ($startDate) {
            $builder->where('date >=', $startDate);
        }
        if ($endDate) {
            $builder->where('date <=', $endDate);
        }

        return $builder->groupBy('transaction_type')->findAll();
    }
}
