<?php

namespace App\Entities;

use App\Models\BansosWarga;
use App\Models\JenisBansos as ModelsJenisBansos;

class JenisBansos extends BaseEntity
{
    protected $modelName = ModelsJenisBansos::class;
    protected $datamap = [
        'id' => 'jenis_id'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    function getJumlahByStatus($status = 0) {
        return model(BansosWarga::class)->join('bansos','bansos_warga.bansos_id = bansos.bansos_id')->join('jenis_bansos','bansos.jenis_id = jenis_bansos.jenis_id')->where(['bansos_warga.status' => $status,'jenis_bansos.jenis_id' => $this->id])->countAllResults();
    }
    function getJumlahByStatusKecamatan($status = 0,$kecamatan_id) {
        return model(BansosWarga::class)->join('bansos','bansos_warga.bansos_id = bansos.bansos_id')->join('jenis_bansos','bansos.jenis_id = jenis_bansos.jenis_id')->join('desa','bansos_warga.desa_id = desa.desa_id')->where(['bansos_warga.status' => $status,'jenis_bansos.jenis_id' => $this->id,'desa.kecamatan_id' => $kecamatan_id])->countAllResults();
    }
}
