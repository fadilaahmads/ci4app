<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        // $komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];

        // Cara konek ke db tanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResultArray() as $row) {
        //     d($row);
        // }

        // $komikModel = new \App\Models\KomikModel();

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' =>  $this->komikModel->getKomik($slug)
        ];
        // Jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            "title" => "Form Tambah Data Komik",
            "validation" => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        //Mengelola data yang dikirim dari create untuk diinsert kedalam tabel

        // Validasi input
        if (!$this->validate([
            // validation rules
            'judul' => 'required|is_unique[komik.judul]'
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/komik/create')->withInput()->with('validation', ' $validation');
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashData('pesan', 'Data berhasil Ditambahkan');

        return redirect()->to('/komik');
    }
}
