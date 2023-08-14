<?php

namespace App\Controllers;

use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        return view('surveillance/login');
    }
    function process() {
        $rules = [
            'username' => [
                'label'  => "Username",
                'rules'  => 'required',
                'errors' => []
            ],
            'password' => [
                'label'  => "Passowrd",
                'rules'  => 'required',
                'errors' => []
            ],
        ];
        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Validasi Gagal", "data" => $this->validator->getErrors()]);
        }
        $data = $this->request->getPost();
        $user = model(User::class)->where(['username' => $data['username']])->first();
        if(!$user){
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Username / Password Salah", "data" =>[]]);
        }
        if(!password_verify($data['password'],$user->password)){
            return $this->response->setStatusCode(400)->setJSON(["status" => false, "message" => "Username / Password Salah", "data" =>[]]);
        }

        $ses['username'] = $user->username;
        $ses['name'] = $user->user_nama;
        $ses['kecamatan_id'] = $user->kecamatan_id;
        $this->session->set($ses);
        if(!$user->kecamatan_id){
            $redir = base_url('admin');
        }else{
            $redir = base_url('surveillance');
        }
        return $this->response->setStatusCode(200)->setJSON(["status" => true, "message" => "Selamat Datang, ".$user->user_nama, "data" =>[
            'redir' => $redir
        ]]);
    }
    function logout() {
        $this->session->destroy();
        return redirect()->to(base_url("login"));
    }
}