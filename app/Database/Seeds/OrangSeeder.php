<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama'          => 'dil',
            'alamat'        => 'jl. abc',
            'created_at'    => Time::now(),
            'updated_at'    => Time::now()
        ];

        // Simple Queries
        $this->db->query("INSERT INTO orang (nama, alamat) VALUES(:nama:, :alamat:)", $data);

        // Using Query Builder
        // $this->db->table('users')->insert($data);
    }
}
