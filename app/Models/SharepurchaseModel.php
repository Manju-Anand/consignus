<?php

namespace App\Models;

use CodeIgniter\Model;

class SharepurchaseModel extends Model
{
    protected $table            = 'share_purchase';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'shareholder_type',
        'member_name',
        'amount_invested',
        'shares_allocated',
        'transaction_date',
        'created_at',
        'memberPhoneno',
        'memberEmail',
        'modified_at'
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


    public function getAvailableShares($type)
    {
        $master = $this->db->table('shareholder_master')->where('type', $type)->get()->getRowArray();
        $sold = $this->db->table('share_purchase')
            ->selectSum('shares_allocated')
            ->where('shareholder_type', $type)
            ->get()->getRowArray();

        return $master['no_of_shares'] - ($sold['shares_allocated'] ?? 0);
    }
}
