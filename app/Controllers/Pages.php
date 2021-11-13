<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('pages/home');
        echo view('layout/footer');
        //return view("pages/home");
    }
    public function about()
    {
        //Calling few views
        echo view('layout/header');
        echo view('pages/about');
        echo view('layout/footer');
        //return view('pages/about');
    }
}
