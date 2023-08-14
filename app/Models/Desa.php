<?php

namespace App\Models;

use App\Entities\Desa as EntitiesDesa;
use CodeIgniter\Model;

class Desa extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'desa';
    protected $primaryKey       = 'desa_id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesDesa::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['desa_nama', 'kecamatan_id'];

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
