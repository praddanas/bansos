<?php

namespace App\Controllers\Surveillance;

use App\Controllers\BaseController;
use App\Models\JenisBansos;

class SurveillanceController extends BaseController
{
    public function index()
    {
        return $this->renderView('surveillance/index',[
            'page_title' => 'Dashboard',
            'jenis_bansoss' => model(JenisBansos::class)->findAll()
        ]);
    }
}
