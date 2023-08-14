<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Desa as EntitiesDesa;
use App\Entities\Kecamatan;
use App\Entities\User;
use App\Models\Desa;
use App\Models\Kecamatan as ModelsKecamatan;
use App\Models\User as ModelsUser;

class DesaController extends BaseController
{
    public function index($kecamatan_id)
    {
        $kecamatan = model(ModelsKecamatan::class)->find($kecamatan_id);
        return $this->renderView('admin/kecamatan/desa/data', [
            'kecamatan' => $kecamatan,
            'page_title' => 'Data Desa Kecamatan '.$kecamatan->kecamatan_nama
        ]);
    }

    function get_table($kecamatan_id)
    {
        $kecamatan = model(ModelsKecamatan::class)->find($kecamatan_id);
        $desas = model(Desa::class)->where('kecamatan_id',$kecamatan_id)->orderBy('desa_nama','asc')->findAll();
        return $this->renderView('admin/kecamatan/desa/table', compact('kecamatan','desas'));
    }

    function tambah($kecamatan_id)
    {
        $kecamatan = model(ModelsKecamatan::class)->find($kecamatan_id);
        if ($this->request->getMethod() == 'post') {
            $rules = [
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
            $desa = model(Desa::class)->where(['kecamatan_id' => $kecamatan_id,'desa_nama' => $data['nama']])->first();
            if($desa){
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => [
                    'nama' => 'Desa Sudah Ada'
                ]]);
            }
            $desa = (new EntitiesDesa([
                'kecamatan_id' => $kecamatan_id,
                'desa_nama' => $data['nama']
            ]))->save();
            if ($desa) {
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menambahkan desa", "data" => [
                    'redir' => base_url('admin/kecamatan/'.$kecamatan_id."/desa")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menambahkan desa", "data" => []]);
            }
        } else {
            $page_title = 'Tambah Desa';
            return $this->renderView('admin/kecamatan/desa/tambah', compact('page_title','kecamatan'));
        }
    }

    function edit($kecamatan_id,$desa_id)
    {
        $kecamatan = model(ModelsKecamatan::class)->find($kecamatan_id);
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama' => [
                    'label'  => "Nama",
                    'rules'  => "required",
                    'errors' => []
                ],
            ];
            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
            }
            $data = $this->request->getPost();
            $desa = model(Desa::class)->where(['kecamatan_id' => $kecamatan_id,'desa_nama' => $data['nama'],'desa_id !=' => $desa_id])->first();
            if($desa){
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => [
                    'nama' => 'Desa Sudah Ada'
                ]]);
            }
            $desa = model(Desa::class)->find($desa_id);
            $desa->desa_nama = $data['nama'];
            if ($desa->update()) {
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menyimpan Data desa", "data" => [
                    'redir' => base_url('admin/kecamatan/'.$kecamatan->kecamatan_id."/desa/".$desa->id."/edit")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menyimpan Data desa", "data" => []]);
            }
        } else {
            $page_title = 'Edit Desa';
            $desa = model(Desa::class)->find($desa_id);
            return $this->renderView('admin/kecamatan/desa/edit', compact('kecamatan','desa', 'page_title'));
        }
    }

    function delete($kecamatan_id,$desa_id)
    {
        $kecamatan = model(ModelsKecamatan::class)->find($kecamatan_id);
        $desa = model(Desa::class)->find($desa_id);
        if ($desa->delete()) {
            return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menghapus desa", "data" => []]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menghapus desa", "data" => []]);
        }
    }
}
