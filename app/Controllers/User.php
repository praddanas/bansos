<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CariData;

class User extends BaseController
{
    public function index()
    {
        return view('index');
    }
    public function cari_data()
    {
        return view('user/cari');
    }
    public function data_cari()
    {
        return view('user/data_cari');
    }

    public function informasi_bantuan()
    {
        return view('user/informasi_bantuan');
    }
    public function informasi_pembagian()
    {
        return view('user/informasi_pembagian');
    }
    public function tentang()
    {
        return view('user/tentang');
    }
}
