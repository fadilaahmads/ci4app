<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | WPU'
        ];
        echo view('layout/header', $data); //data sent to header.php
        echo view('pages/home');
        echo view('layout/footer');
        //return view("pages/home");
    }
    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];
        //Calling few views
        echo view('layout/header', $data);
        echo view('pages/about');
        echo view('layout/footer');
        //return view('pages/about');
    }
}
