<?php

namespace App\Models;

use CodeIgniter\Model;

class CariData extends Model
{
    protected $table = 'bansos_warga'; // Replace with your actual table name
    protected $primaryKey = 'bansos_warga_id'; // Replace with your primary key column

    public function searchData($searchQuery)
    {
        // Perform the database query to search for data
        return $this->like('bansos_warga', $searchQuery)->findAll();
    }
}
