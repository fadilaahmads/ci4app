<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        echo "Ini controller coba method index ";
    }
    public function about()
    {
        echo "Halo, nama saya $this->nama";
    }
}
