<?php

namespace App\Entities;

use App\Models\Desa as ModelsDesa;
use App\Models\Kecamatan;

class Desa extends BaseEntity
{
    protected $modelName = ModelsDesa::class;
    protected $datamap = [
        'id' => 'desa_id'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    function getKecamatan() {
        return model(Kecamatan::class)->where('kecamatan_id',$this->kecamatan_id)->first();
    }
}