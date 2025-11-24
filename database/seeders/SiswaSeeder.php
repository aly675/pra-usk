<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nama' => 'Billy Caesar Rajawali',
            'nis' => '11710',
            'kelas' => 'xi',
            'jurusan' => 'RPL',
            'jenis_kelamin' => 'Laki-laki'
        ]);
        // Siswa::create([
        //     'nama' => 'Daffa Dwi Putra',
        //     'nis' => '11711',
        //     'kelas' => 'xi',
        //     'jurusan' => 'RPL',
        //     'jenis_kelamin' => 'Laki-laki'
        // ]);
        // Siswa::create([
        //     'nama' => 'Dea Lova Syafitri',
        //     'nis' => '11710',
        //     'kelas' => 'xi',
        //     'jurusan' => 'RPL',
        //     'jenis_kelamin' => 'Laki-laki'
        // ]);
    }
}
