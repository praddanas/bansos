<?php

namespace App\Models;

use App\Entities\JenisBansos as EntitiesJenisBansos;
use CodeIgniter\Model;

class JenisBansos extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jenis_bansos';
    protected $primaryKey       = 'jenis_id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesJenisBansos::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jenis_nama'];

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
