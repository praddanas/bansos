<?php

namespace App\Models;

use App\Entities\Warga as EntitiesWarga;
use CodeIgniter\Model;

class Warga extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'warga';
    protected $primaryKey       = 'warga_id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesWarga::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'desa_id', 'warga_nama', 'warga_nik', 'warga_rt_rw', 'warga_jk', 'warga_usia'
    ];

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
}
