<?php

namespace App\Models;

use CodeIgniter\Model;

class ShareholdermasterModel extends Model
{
    protected $table            = 'shareholder_master';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'type', 'no_of_shares', 'face_value', 'created_at', 'updated_at'];

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

    public function getSharesOwnedByType($type)
    {
        // Get the master record by type
        $master = $this->where('type', $type)->first();
    
        if (!$master) {
            return null;
        }
    
        // Get allocated shares (from ShareTransactionModel)
        $shareTransactionModel = new \App\Models\SharepurchaseModel();
        $sold = $shareTransactionModel->where('shareholder_type', $type)->selectSum('shares_allocated')->first();
        $allocated = $sold['shares_allocated'] ?? 0;
    
        return [
            'face_value' => $master['face_value'],
            'total_shares' => $master['no_of_shares'],
            'allocated_shares' => $allocated,
            'remaining_shares' => $master['no_of_shares'] - $allocated
        ];
    }
    
}
