<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisBansos;

class AdminController extends BaseController
{
    public function index()
    {
        return $this->renderView('admin/index',[
            'page_title' => 'Dashboard',
            'jenis_bansoss' => model(JenisBansos::class)->findAll()
        ]);
    }
}