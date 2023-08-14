<?php

namespace App\Models;

use App\Entities\Kecamatan as EntitiesKecamatan;
use CodeIgniter\Model;

class Kecamatan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kecamatan';
    protected $primaryKey       = 'kecamatan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesKecamatan::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kecamatan_nama'];

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
