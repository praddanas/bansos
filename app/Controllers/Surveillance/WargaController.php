<?php

namespace App\Controllers\Surveillance;

use App\Controllers\BaseController;
use App\Entities\Warga as EntitiesWarga;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Warga;

class WargaController extends BaseController
{
    public function index()
    {
        return $this->renderView('surveillance/warga/data', [
            'page_title' => 'Data Warga',
            'desas' => model(Desa::class)->where('kecamatan_id', $this->user->kecamatan_id)->findAll()
        ]);
    }

    function get_warga()
    {
        $desa_id = $this->request->getPost('desa_id');
        if (empty($desa_id)) {
            $desa_id = '-1';
        }
        $where = [];
        $where['kecamatan.kecamatan_id'] = $this->user->kecamatan_id;
        if ($desa_id != '-1') {
            $where['desa.desa_id'] = $desa_id;
        }
        $wargas = model(Warga::class)->select('warga.*')->join("desa", "warga.desa_id = desa.desa_id")->join('kecamatan', "desa.kecamatan_id = kecamatan.kecamatan_id")->where($where)->get()->getResultArray();
        return $this->renderView('surveillance/warga/list', compact('wargas'));
    }

    function detail($warga_id)
    {
        $warga = model(Warga::class)->join('desa', 'warga.desa_id = desa.desa_id')->where('kecamatan_id', $this->user->kecamatan_id)->find($warga_id);
        $page_title = 'Detail Warga ' . $warga->warga_nama;
        return $this->renderView('surveillance/warga/detail', compact('warga', 'page_title'));
    }

    function tambah()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nik' => [
                    'label'  => "NIK",
                    'rules'  => 'required|is_unique[warga.warga_nik,warga_id]',
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
            $warga = (new EntitiesWarga([
                'desa_id' => $data['desa_id'],
                'warga_nama' => $data['nama'],
                'warga_nik' => $data['nik'],
                'warga_rt_rw' => $data['rt_rw'],
                'warga_jk' => $data['jk'],
                'warga_usia' => (int) $data['usia']
            ]))->save();
            if ($warga) {
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menambahkan Warga", "data" => [
                    'redir' => base_url('surveillance/warga/' . $warga->warga_id . "/detail")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menambahkan Warga", "data" => []]);
            }
        } else {
            $page_title = 'Tambah Warga';
            $desas = model(Desa::class)->where('kecamatan_id', $this->user->kecamatan_id)->findAll();
            return $this->renderView('surveillance/warga/tambah', compact('desas', 'page_title'));
        }
    }
    function edit($warga_id)
    {
        $warga = model(Warga::class)->join('desa', 'warga.desa_id = desa.desa_id')->where('kecamatan_id', $this->user->kecamatan_id)->find($warga_id);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nik' => [
                    'label'  => "NIK",
                    'rules'  => "required|is_unique[warga.warga_nik,warga_id,{$warga->warga_id}]",
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
            $warga->desa_id = $data['desa_id'];
            $warga->warga_nama = $data['nama'];
            $warga->warga_nik = $data['nik'];
            $warga->warga_jk = $data['jk'];
            $warga->warga_rt_rw = $data['rt_rw'];
            $warga->warga_usia = $data['usia'];
            if ($warga->update()) {
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menyimpan Data Warga", "data" => [
                    'redir' => base_url('surveillance/warga/' . $warga->warga_id . "/edit")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menyimpan Data Warga", "data" => []]);
            }
        } else {
            $page_title = 'Edit Warga';
            $desas = model(Desa::class)->where('kecamatan_id', $this->user->kecamatan_id)->findAll();
            return $this->renderView('surveillance/warga/edit', compact('desas', 'page_title', 'warga'));
        }
    }

    function delete($warga_id)
    {
        $warga = model(Warga::class)->join('desa', 'warga.desa_id = desa.desa_id')->where('kecamatan_id', $this->user->kecamatan_id)->find($warga_id);
        if ($warga->delete()) {
            return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menghapus Warga", "data" => []]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menghapus Warga", "data" => []]);
        }
    }
}
