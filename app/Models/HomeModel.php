<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{




    public function getLoggedInUserData($id)
    {
        $builder = $this->db->table('users');
        $builder->where('id', $id);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            // return $result->getResultArray()[0];
            return $result->getRow();
        } else {
            return false;
        }
    }
    public function updateLogoutTime($laid)
    {
        $builder = $this->db->table('loginactivity');
        $builder->where('id', $laid);
        $builder->update(['logout_time' => date('Y-m-d H:i:s')]);
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }
}
