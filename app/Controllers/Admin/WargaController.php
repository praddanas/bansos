<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Warga as EntitiesWarga;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Warga;

class WargaController extends BaseController
{
    public function index()
    {
        return $this->renderView('admin/warga/data', [
            'page_title' => 'Data Warga',
            'kecamatans' => model(Kecamatan::class)->findAll()
        ]);
    }

    function get_desa()
    {
        $kecamatan_id = $this->request->getPost('kecamatan');
        if ($kecamatan_id == '-1') {
            return '';
        } else {
            $desas = model(Desa::class)->where('kecamatan_id', $kecamatan_id)->findAll();
            return $this->renderView('admin/warga/select_desa', compact('desas'));
        }
    }

    function get_warga()
    {
        $kecamatan_id = $this->request->getPost('kecamatan_id');
        $desa_id = $this->request->getPost('desa_id');
        if (empty($desa_id)) {
            $desa_id = '-1';
        }
        $where = [];
        if ($kecamatan_id != '-1') {
            $where['kecamatan.kecamatan_id'] = $kecamatan_id;
        }
        if ($desa_id != '-1') {
            $where['desa.desa_id'] = $desa_id;
        }
        $wargas = model(Warga::class)->select('warga.*')->join("desa", "warga.desa_id = desa.desa_id")->join('kecamatan', "desa.kecamatan_id = kecamatan.kecamatan_id")->where($where)->limit(10)->get()->getResultArray();
        return $this->renderView('admin/warga/list', compact('wargas'));
    }

    function detail($warga_id)
    {
        $warga = model(Warga::class)->find($warga_id);
        $page_title = 'Detail Warga ' . $warga->warga_nama;
        return $this->renderView('admin/warga/detail', compact('warga', 'page_title'));
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
                'kecamatan_id' => [
                    'label'  => "Kecamatan",
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
                    'redir' => base_url('admin/warga/'.$warga->warga_id."/detail")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menambahkan Warga", "data" => []]);
            }
        } else {
            $page_title = 'Tambah Warga';
            $kecamatans = model(Kecamatan::class)->findAll();
            return $this->renderView('admin/warga/tambah', compact('kecamatans', 'page_title'));
        }
    }
    function get_desa_form()
    {
        $kecamatan_id = $this->request->getPost('kecamatan');
        $desas = model(Desa::class)->where('kecamatan_id', $kecamatan_id)->findAll();
        return $this->renderView('admin/warga/select_desa_form', compact('desas'));
    }
    function edit($warga_id)
    {
        $warga = model(Warga::class)->find($warga_id);
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
                'kecamatan_id' => [
                    'label'  => "Kecamatan",
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
                    'redir' => base_url('admin/warga/'.$warga->warga_id."/edit")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menyimpan Data Warga", "data" => []]);
            }
        } else {
            $page_title = 'Edit Warga';
            $kecamatans = model(Kecamatan::class)->findAll();
            return $this->renderView('admin/warga/edit', compact('kecamatans', 'page_title','warga'));
        }
    }

    function delete($warga_id)
    {
        $warga = model(Warga::class)->find($warga_id);
        if ($warga->delete()) {
            return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menghapus Warga", "data" => []]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menghapus Warga", "data" => []]);
        }
    }
}
