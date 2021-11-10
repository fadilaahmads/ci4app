<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        echo "Ini controller coba method index ";
    }
    public function about($nama = " ", $umur = " ")
    {
        echo "Halo, nama saya $nama, saya berumur $umur tahun";
    }
}
