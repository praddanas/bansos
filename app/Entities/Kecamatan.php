<?php

namespace App\Entities;

use App\Models\Kecamatan as ModelsKecamatan;

class Kecamatan extends BaseEntity
{
    protected $modelName = ModelsKecamatan::class;
    protected $datamap = [
        'id' => 'kecamatan_id'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
