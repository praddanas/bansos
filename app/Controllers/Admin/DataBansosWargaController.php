<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Bansos;
use App\Models\BansosWarga;

class DataBansosWargaController extends BaseController
{
    public function index($bansos_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        return $this->renderView('admin/bansos/warga/data', [
            'page_title' => 'Data Bansos',
            'bansos' => $bansos
        ]);
    }

    function get_table($bansos_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        $bansos_wargas = model(BansosWarga::class)->where('bansos_id', $bansos_id)->orderBy('status', 'asc')->get()->getResultArray();
        return $this->renderView('admin/bansos/warga/table', compact('bansos_wargas', 'bansos'));
    }

    function set_status($bansos_id, $warga_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        $bansos_warga = model(BansosWarga::class)->find($warga_id);
        $status = 0;
        $message = 'Membatalkan Proses';
        $act = $this->request->getPost('act');
        if ($act == 'approve') {
            $message = 'Menerima Data';
            $status = 1;
        } else if ($act == 'decline') {
            $message = 'Menolak Data';
            $status = 2;
        }
        $bansos_warga->status = $status;
        if ($bansos_warga->update()) {
            return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil {$message} Bansos Warga", "data" => []]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal {$message} Bansos Warga", "data" => []]);
        }
    }
}
