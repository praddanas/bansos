<?php

namespace App\Controllers;

class Surveillance extends BaseController
{
    public function login()
    {
        return view('surveillance/login');
    }
    public function index()
    {
        return view('surveillance/index');
    }
    public function edit_admin()
    {
        return view('surveillance/edit_admin');
    }
    public function tambah_data()
    {
        return view('surveillance/tambah_data');
    }
    public function data_warga()
    {
        return view('surveillance/data_warga');
    }
}
