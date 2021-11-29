<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama' => 'dil',
            'alamat'    => 'jl. abc'
        ];

        // Simple Queries
        $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
