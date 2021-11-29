<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        $timeWIB = Time::now('Asia/Jakarta');
        $data = [
            [
                'nama'          => 'Dil',
                'alamat'        => 'Jl. ABCD no.99',
                'created_at'    => $timeWIB,
                'updated_at'    => $timeWIB
            ],
            [
                'nama'          => 'Dal',
                'alamat'        => 'Jl. ABCD no.01',
                'created_at'    => $timeWIB,
                'updated_at'    => $timeWIB
            ],
            [
                'nama'          => 'Dul',
                'alamat'        => 'Jl. ABCD no.02',
                'created_at'    => $timeWIB,
                'updated_at'    => $timeWIB
            ]
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO orang (nama, alamat, created_at, updated_at) 
        // VALUES(:nama:, :alamat:, :created_at:, :updated_at:)", $data);

        // Using Query Builder
        // $this->db->table('orang')->insert($data);
        $this->db->table('orang')->insertBatch($data);
    }
}
