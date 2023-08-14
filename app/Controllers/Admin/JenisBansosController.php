<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\JenisBansos as EntitiesJenisBansos;
use App\Models\JenisBansos;

class JenisBansosController extends BaseController
{
    public function index()
    {
        return $this->renderView('admin/jenis_bansos/data', [
            'page_title' => 'Data Jenis Bansos'
        ]);
    }

    function get_table()
    {
        $jenis_bansoss = model(JenisBansos::class)->orderBy('jenis_nama', 'asc')->findAll();
        return $this->renderView('admin/jenis_bansos/table', compact('jenis_bansoss'));
    }

    function tambah()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama' => [
                    'label'  => "Nama",
                    'rules'  => 'required|is_unique[jenis_bansos.jenis_nama,jenis_id]',
                    'errors' => []
                ],
            ];
            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
            }
            $data = $this->request->getPost();
            $jenis = (new EntitiesJenisBansos([
                'jenis_nama' => $data['nama']
            ]))->save();
            if ($jenis) {
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menambahkan jenis bansos", "data" => [
                    'redir' => base_url('admin/jenis_bansos')
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menambahkan jenis bansos", "data" => []]);
            }
        } else {
            $page_title = 'Tambah Jenis Bansos';
            return $this->renderView('admin/jenis_bansos/tambah', compact('page_title'));
        }
    }

    function edit($jenis_bansos_id)
    {
        $jenis_bansos = model(JenisBansos::class)->find($jenis_bansos_id);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama' => [
                    'label'  => "Nama",
                    'rules'  => "required|is_unique[jenis_bansos.jenis_nama,jenis_id,{$jenis_bansos_id}]",
                    'errors' => []
                ],
            ];
            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
            }
            $data = $this->request->getPost();
            $jenis_bansos->jenis_nama = $data['nama'];
            if ($jenis_bansos->update()) {
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menyimpan Data jenis bansos", "data" => [
                    'redir' => base_url('admin/jenis_bansos/' . $jenis_bansos->jenis_id . "/edit")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menyimpan Data jenis bansos", "data" => []]);
            }
        } else {
            $page_title = 'Edit Jenis Bansos';
            return $this->renderView('admin/jenis_bansos/edit', compact('jenis_bansos', 'page_title'));
        }
    }

    function delete($jenis_bansos_id)
    {
        $jenis_bansos = model(JenisBansos::class)->find($jenis_bansos_id);
        if ($jenis_bansos->delete()) {
            return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menghapus jenis bansos", "data" => []]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menghapus jenis bansos", "data" => []]);
        }
    }
}
