<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'          => 'Dil',
                'alamat'        => 'Jl. ABCD no.99',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ],
            [
                'nama'          => 'Dal',
                'alamat'        => 'Jl. ABCD no.01',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ],
            [
                'nama'          => 'Dul',
                'alamat'        => 'Jl. ABCD no.02',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ]
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO orang (nama, alamat, created_at, updated_at) 
        // VALUES(:nama:, :alamat:, :created_at:, :updated_at:)", $data);

        // Using Query Builder
        $this->db->table('orang')->insert($data);
    }
}
