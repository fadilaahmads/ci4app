<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $orangModel;
    public function __construct()
    {
        $this->orangModel = new orangModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Daftar Orang',
            'orang' => $this->orangModel->paginate(5),
            'pager' => $this->orangModel->pager
        ];
        return view('orang/index', $data);
    }
}
