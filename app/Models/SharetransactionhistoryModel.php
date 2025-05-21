<?php

namespace App\Models;

use CodeIgniter\Model;

class SharetransactionhistoryModel extends Model
{
    protected $table            = 'share_transaction_history';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'shareholder_name',
        'shareholder_type',
        'transaction_type',
        'shares',
        'amount',
        'policy',
        'transaction_date',
        'related_party',
        'remarks',
        'created_at',
        'transaction_id',
        'purchaseid'
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

    public function getMonthlyShareSales()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('share_transaction_history');
        $builder->select("DATE_FORMAT(transaction_date, '%b') as month, COUNT(id) as count");
        $builder->where('transaction_type', 'sale');
        $builder->groupBy("MONTH(transaction_date)");
        $builder->orderBy("MONTH(transaction_date)", 'ASC');

        return $builder->get()->getResultArray();
    }

    public function getMonthlyShareTransactions()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('share_transaction_history');
        $builder->select("DATE_FORMAT(transaction_date, '%b') as month,
                      SUM(CASE WHEN transaction_type = 'purchase' THEN 1 ELSE 0 END) as purchases,
                      SUM(CASE WHEN transaction_type = 'sale' THEN 1 ELSE 0 END) as sales");
        $builder->groupBy("MONTH(transaction_date)");
        $builder->orderBy("MONTH(transaction_date)", 'ASC');

        return $builder->get()->getResultArray();
    }
}
