<?php

namespace App\Controllers\Surveillance;

use App\Controllers\BaseController;
use App\Models\Bansos;

class DataBansosController extends BaseController
{
    public function index()
    {
        return $this->renderView('surveillance/bansos/data', [
            'page_title' => 'Data Bansos'
        ]);
    }

    function get_table()
    {
        $bansoss = model(Bansos::class)->orderBy('bansos_id', 'desc')->findAll();
        return $this->renderView('surveillance/bansos/table', compact('bansoss'));
    }
}
