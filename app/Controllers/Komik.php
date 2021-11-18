<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Komik'
        ];

        // Cara konek ke db tanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResultArray() as $row) {
        //     d($row);
        // }

        // $komikModel = new \App\Models\KomikModel();
        $komikModel = new KomikModel();

        return view('komik/index', $data);
    }
}
