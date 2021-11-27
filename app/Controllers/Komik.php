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
            'judul' =>  [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ],
                'sampul' => [
                    'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Pilih  gambar sampul terlebih dahulu',
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();

            // return redirect()->to('/komik/create')->withInput()->with('validation', ' $validation');
            return redirect()->to('/komik/create')->withInput();
        }

        // Ambil Gambar
        $fileSampul = $this->request->getFile('sampul');
        // Pindahkan ke folder img
        $fileSampul->move('img');
        // Ambil Nama file
        $namaSampul = $fileSampul->getName();


        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashData('pesan', 'Data berhasil Ditambahkan');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $this->komikModel->delete($id);
        session()->setFlashData('pesan', 'Data berhasil Dihapus');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            "title" => "Form Ubah Data Komik",
            "validation" => \Config\Services::validation(),
            "komik" => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {
        // Cek Judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = "required|is_unique[komik.judul]";
        }

        // Validasi input
        if (!$this->validate([
            // validation rules
            'judul' =>  [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih  gambar sampul terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();

            // return redirect()->to('/komik/create')->withInput()->with('validation', ' $validation');
            return redirect()->to('/komik/create')->withInput();
        }

        // Ambil Gambar
        $fileSampul = $this->request->getFile('sampul');
        // Pindahkan ke folder img
        $fileSampul->move('img');
        // Ambil Nama file
        $namaSampul = $fileSampul->getName();

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashData('pesan', 'Data berhasil Diubah');

        return redirect()->to('/komik');
    }
}
