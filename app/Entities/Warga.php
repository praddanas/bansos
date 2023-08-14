<?php

namespace App\Entities;

use App\Models\BansosWarga;
use App\Models\Desa;
use App\Models\Warga as ModelsWarga;

class Warga extends BaseEntity
{
    protected $modelName = ModelsWarga::class;
    protected $datamap = [
        'id' => 'warga_id'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    function getDesa() {
        return model(Desa::class)->where('desa_id',$this->desa_id)->first();
    }
    function getBansos() {
        return model(BansosWarga::class)->where('bansos_warga_nik',$this->warga_nik)->orderBy('bansos_id','desc')->findAll();
    }
}