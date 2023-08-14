<?php

namespace App\Models;

use App\Entities\BansosWarga as EntitiesBansosWarga;
use CodeIgniter\Model;

class BansosWarga extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bansos_warga';
    protected $primaryKey       = 'bansos_warga_id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesBansosWarga::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bansos_id', 'bansos_warga_nik', 'desa_id', 'warga_rt_rw', 'warga_usia', 'status'
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
