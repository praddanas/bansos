<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Kecamatan;
use App\Entities\User;
use App\Models\Kecamatan as ModelsKecamatan;
use App\Models\User as ModelsUser;

class KecamatanController extends BaseController
{
    public function index()
    {
        return $this->renderView('admin/kecamatan/data', [
            'page_title' => 'Data Kecamatan'
        ]);
    }

    function get_table()
    {
        $kecamatans = model(ModelsKecamatan::class)->orderBy('kecamatan_nama','asc')->findAll();
        return $this->renderView('admin/kecamatan/table', compact('kecamatans'));
    }

    function tambah()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama' => [
                    'label'  => "Nama",
                    'rules'  => 'required|is_unique[kecamatan.kecamatan_nama,kecamatan_id]',
                    'errors' => []
                ],
            ];
            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
            }
            $data = $this->request->getPost();
            $kecamatan = (new Kecamatan([
                'kecamatan_nama' => $data['nama']
            ]))->save();
            if ($kecamatan) {
                (new User([
                    'kecamatan_id' => $kecamatan->kecamatan_id,
                    'user_nama' => 'Admin Kecamatan ' . $kecamatan->kecamatan_nama,
                    'username' => strtolower($kecamatan->kecamatan_nama),
                    'password' => password_hash("123456", PASSWORD_DEFAULT)
                ]))->save();
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menambahkan kecamatan", "data" => [
                    'redir' => base_url('admin/kecamatan')
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menambahkan kecamatan", "data" => []]);
            }
        } else {
            $page_title = 'Tambah Kecamatan';
            return $this->renderView('admin/kecamatan/tambah', compact('page_title'));
        }
    }

    function edit($kecamatan_id)
    {
        $kecamatan = model(ModelsKecamatan::class)->find($kecamatan_id);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama' => [
                    'label'  => "Nama",
                    'rules'  => "required|is_unique[kecamatan.kecamatan_nama,kecamatan_id,{$kecamatan_id}]",
                    'errors' => []
                ],
            ];
            if (!$this->validate($rules)) {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
            }
            $data = $this->request->getPost();
            $kecamatan->kecamatan_nama = $data['nama'];
            if ($kecamatan->update()) {
                $user = model(ModelsUser::class)->where('kecamatan_id',$kecamatan_id)->first();
                $user->user_nama = 'Admin Kecamatan '.$data['nama'];
                $user->username = strtolower($data['nama']);
                $user->update();
                return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menyimpan Data kecamatan", "data" => [
                    'redir' => base_url('admin/kecamatan/'.$kecamatan->kecamatan_id."/edit")
                ]]);
            } else {
                return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menyimpan Data kecamatan", "data" => []]);
            }
        } else {
            $page_title = 'Edit Kecamatan';
            return $this->renderView('admin/kecamatan/edit', compact('kecamatan', 'page_title'));
        }
    }

    function delete($kecamatan_id)
    {
        $kecamatan = model(ModelsKecamatan::class)->find($kecamatan_id);
        if(sizeof($kecamatan->desa) > 0){
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Silahkan hapus desa di kecamatan ini terlebih dahulu", "data" => []]);
        }
        if ($kecamatan->delete()) {
            return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Berhasil Menghapus kecamatan", "data" => []]);
        } else {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Gagal Menghapus kecamatan", "data" => []]);
        }
    }
}
