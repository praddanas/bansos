<?php

namespace App\Models;

use App\Entities\Bansos as EntitiesBansos;
use CodeIgniter\Model;

class Bansos extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bansos';
    protected $primaryKey       = 'bansos_id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesBansos::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['bansos_nama','jenis_id'];

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
