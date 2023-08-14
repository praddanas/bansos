<?php

namespace App\Entities;

use App\Models\Bansos;
use App\Models\BansosWarga as ModelsBansosWarga;
use CodeIgniter\Entity\Entity;

class BansosWarga extends BaseEntity
{
    protected $modelName = ModelsBansosWarga::class;
    protected $datamap = [
        'id' => 'bansos_warga_id'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    function getBansos() {
        return model(Bansos::class)->find($this->bansos_id);
    }
}
