<?php

namespace App\Entities;

use App\Models\Bansos as ModelsBansos;
use App\Models\BansosWarga;
use App\Models\JenisBansos;
use CodeIgniter\Entity\Entity;

class Bansos extends BaseEntity
{
    protected $modelName = ModelsBansos::class;
    protected $datamap = [
        'id' => 'bansos_id'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    function getJenis()
    {
        return model(JenisBansos::class)->find($this->jenis_id);
    }

    function getJumlahWarga($status = 0)
    {
        return model(BansosWarga::class)->join('bansos', 'bansos_warga.bansos_id = bansos.bansos_id')->where(['bansos_warga.status' => $status, 'bansos_warga.bansos_id' => $this->id])->countAllResults();
    }
    function getJumlahWargaKecamatan($status = 0,$kecamatan_id)
    {
        return model(BansosWarga::class)->join('bansos', 'bansos_warga.bansos_id = bansos.bansos_id')->join('desa','bansos_warga.desa_id = desa.desa_id')->where(['bansos_warga.status' => $status, 'bansos_warga.bansos_id' => $this->id,'desa.kecamatan_id' => $kecamatan_id])->countAllResults();
    }
}
