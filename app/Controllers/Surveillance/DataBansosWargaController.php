<?php

namespace App\Controllers\Surveillance;

use App\Controllers\BaseController;
use App\Entities\BansosWarga as EntitiesBansosWarga;
use App\Entities\Warga as EntitiesWarga;
use App\Models\Bansos;
use App\Models\BansosWarga;
use App\Models\Desa;
use App\Models\Warga;

class DataBansosWargaController extends BaseController
{
    public function index($bansos_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        return $this->renderView('surveillance/bansos/warga/data', [
            'page_title' => 'Data Bansos',
            'bansos' => $bansos
        ]);
    }

    function get_table($bansos_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        $bansos_wargas = model(BansosWarga::class)->join('desa','bansos_warga.desa_id = desa.desa_id')->where('bansos_id', $bansos_id)->where('desa.kecamatan_id',$this->user->kecamatan_id)->orderBy('status', 'asc')->get()->getResultArray();
        return $this->renderView('surveillance/bansos/warga/table', compact('bansos_wargas', 'bansos'));
    }
    function tambah($bansos_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nik' => [
                    'label'  => "NIK",
                    'rules'  => 'required',
                    'errors' => []
                ],
                'nama' => [
                    'label'  => "Nama",
                    'rules'  => 'required',
                    'errors' => []
                ],
                'rt_rw' => [
                    'label'  => "RT/RW",
                    'rules'  => 'required',
                    'errors' => []
                ],
                'jk' => [
                    'label'  => "Jenis Kelamin",
                    'rules'  => 'required',
                    'errors' => []
                ],
                'usia' => [
                    'label'  => "Usia",
                    'rules'  => 'required',
                    'errors' => []
                ],
                'desa_id' => [
                    'label'  => "Desa",
                    'rules'  => 'required',
                    'errors' => []
                ],
            ];
            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
            }
            $data = $this->request->getPost();
            $bansos_warga = model(BansosWarga::class)->where(['bansos_warga_nik' => $data['nik'],'bansos_id' => $bansos->id])->first();
            if($bansos_warga){
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "NIK Sudah Ada di Bansos Ini", "data" => []]);
            }
            $warga = model(Warga::class)->where(['warga_nik' => $data['nik']])->first();
            if($warga){
                if($warga->desa->kecamatan_id != $this->user->kecamatan_id){
                    return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "NIK ini sudah ada di kecamatan lain", "data" => []]);
                }
                $warga->desa_id = $data['desa_id'];
                $warga->warga_nama = $data['nama'];
                $warga->warga_nik = $data['nik'];
                $warga->warga_rt_rw = $data['rt_rw'];
                $warga->warga_jk = $data['jk'];
                $warga->warga_usia = $data['usia'];
                $warga = $warga->update();
            }else{
                $warga = (new EntitiesWarga([
                    'desa_id' => $data['desa_id'],
                    'warga_nama' => $data['nama'],
                    'warga_nik' => $data['nik'],
                    'warga_rt_rw' => $data['rt_rw'],
                    'warga_jk' => $data['jk'],
                    'warga_usia' => (int) $data['usia']
                ]))->save();
            }
            if ($warga) {
                (new EntitiesBansosWarga([
                    'bansos_id' => $bansos->id, 
                    'bansos_warga_nik' => $data['nik'],
                    'desa_id' => $data['desa_id'], 
                    'warga_rt_rw' => $data['rt_rw'], 
                    'warga_usia' => (int) $data['usia'],
                    'status' => 0
                ]))->save();
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menambahkan Warga Di Data Bansos", "data" => [
                    'redir' => base_url('surveillance/data_bansos/'.$bansos->bansos_id."/warga")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menambahkan Warga Di Data Bansos", "data" => []]);
            }
        } else {
            $page_title = 'Tambah Warga Di Data Bansos '.$bansos->bansos_nama;
            $desas = model(Desa::class)->where('kecamatan_id',$this->user->kecamatan_id)->findAll();
            return $this->renderView('surveillance/bansos/warga/tambah', compact('desas', 'page_title','bansos'));
        }
    }

    function cari($bansos_id) {
        $bansos = model(Bansos::class)->find($bansos_id);
        $data = $this->request->getPost();
        $bansos_warga = model(BansosWarga::class)->where(['bansos_warga_nik' => $data['nik'],'bansos_id' => $bansos->id])->first();
        if($bansos_warga){
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Warga Sudah Ada Di Data Bansos ini", "data" => []]);
        }else{
            $warga = model(Warga::class)->where(['warga_nik' => $data['nik']])->first();
            if($warga){
                if($warga->desa->kecamatan_id != $this->user->kecamatan_id){
                    return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "NIK ini sudah ada di kecamatan lain", "data" => []]);
                }
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Warga Ditemukan", "data" => [
                    'nama' => $warga->warga_nama,
                    'rt_rw' => $warga->warga_rt_rw,
                    'jk' => $warga->warga_jk,
                    'usia' => $warga->warga_usia,
                    'desa_id' => $warga->desa_id,
                ]]);
            }else{
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Warga Tidak Ditemukan", "data" => []]);
            }
        }
    }

    function delete($bansos_id,$warga_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        $warga = model(BansosWarga::class)->join('desa','bansos_warga.desa_id = desa.desa_id')->where('desa.kecamatan_id',$this->user->kecamatan_id)->where('bansos_id',$bansos->id)->find($warga_id);
        if ($warga->delete()) {
            return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menghapus Warga dari data bansos ini", "data" => []]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menghapus Warga dari data bansos ini", "data" => []]);
        }
    }
}
