<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Bansos as EntitiesBansos;
use App\Models\Bansos;
use App\Models\JenisBansos;

class DataBansosController extends BaseController
{
    public function index()
    {
        return $this->renderView('admin/bansos/data', [
            'page_title' => 'Data Bansos'
        ]);
    }

    function get_table()
    {
        $bansoss = model(Bansos::class)->orderBy('bansos_id', 'desc')->findAll();
        return $this->renderView('admin/bansos/table', compact('bansoss'));
    }

    function tambah()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'jenis_id' => [
                    'label'  => "Jenis Bansos",
                    'rules'  => 'required',
                    'errors' => []
                ],
                'nama' => [
                    'label'  => "Nama",
                    'rules'  => 'required',
                    'errors' => []
                ],
            ];
            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
            }
            $data = $this->request->getPost();
            $bansos = (new EntitiesBansos([
                'jenis_id' => $data['jenis_id'],
                'bansos_nama' => $data['nama'],
            ]))->save();
            if ($bansos) {
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menambahkan data bansos", "data" => [
                    'redir' => base_url('admin/data_bansos')
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menambahkan data bansos", "data" => []]);
            }
        } else {
            $page_title = 'Tambah Data Bansos';
            $jenis_bansoss = model(JenisBansos::class)->findAll();
            return $this->renderView('admin/bansos/tambah', compact('page_title', 'jenis_bansoss'));
        }
    }

    function edit($bansos_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'jenis_id' => [
                    'label'  => "Jenis Bansos",
                    'rules'  => 'required',
                    'errors' => []
                ],
                'nama' => [
                    'label'  => "Nama",
                    'rules'  => 'required',
                    'errors' => []
                ],
            ];
            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
            }
            $data = $this->request->getPost();
            $bansos->jenis_id = $data['jenis_id'];
            $bansos->bansos_nama = $data['nama'];
            if ($bansos->update()) {
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menyimpan Data bansos", "data" => [
                    'redir' => base_url('admin/data_bansos/' . $bansos->id . "/edit")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menyimpan Data bansos", "data" => []]);
            }
        } else {
            $page_title = 'Edit Data Bansos';
            $jenis_bansoss = model(JenisBansos::class)->findAll();
            return $this->renderView('admin/bansos/edit', compact('bansos', 'jenis_bansoss', 'page_title'));
        }
    }

    function delete($bansos_id)
    {
        $bansos = model(Bansos::class)->find($bansos_id);
        if ($bansos->delete()) {
            return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menghapus bansos", "data" => []]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menghapus bansos", "data" => []]);
        }
    }
}
