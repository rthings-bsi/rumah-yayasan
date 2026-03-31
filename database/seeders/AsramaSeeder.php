<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsramaSeeder extends Seeder
{
    public function run(): void
    {
        $asramas = [];
        for ($i = 1; $i <= 40; $i++) {
            $kode = 'RH' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $nama = 'Rumah Harapan ' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $asramas[] = [
                'kode_asrama' => $kode,
                'nama_asrama' => $nama,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('asramas')->insertOrIgnore($asramas);
    }
}
