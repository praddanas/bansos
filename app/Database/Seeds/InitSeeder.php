<?php

namespace App\Database\Seeds;

use App\Entities\Bansos as EntitiesBansos;
use App\Entities\BansosWarga;
use App\Entities\Desa as EntitiesDesa;
use App\Entities\JenisBansos as EntitiesJenisBansos;
use App\Entities\Kecamatan as EntitiesKecamatan;
use App\Entities\User;
use App\Entities\Warga as EntitiesWarga;
use App\Models\Bansos;
use App\Models\Desa;
use App\Models\JenisBansos;
use App\Models\Kecamatan;
use App\Models\Warga;
use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {

        (new User([
            'kecamatan_id' => null,
            'user_nama' => 'Admin Dinsos',
            'username' => 'dinsos',
            'password' => password_hash("123456", PASSWORD_DEFAULT)
        ]))->save();
        // Input Warga
        $inputFileName = APPPATH . '../data_warga.xlsx';

        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $list = $worksheet->toArray();
        for ($i = 1; $i < $highestRow; $i++) {
            $data = $list[$i];
            if (empty($data[2])) {
                continue;
            }
            $kecamatan_nama = $data[3];
            $kecamatan = model(Kecamatan::class)->where(['kecamatan_nama' => $kecamatan_nama])->first();
            if (!$kecamatan) {
                (new EntitiesKecamatan(['kecamatan_nama' => $kecamatan_nama]))->save();
                $kecamatan = model(Kecamatan::class)->where(['kecamatan_nama' => $kecamatan_nama])->first();
                (new User([
                    'kecamatan_id' => $kecamatan->kecamatan_id,
                    'user_nama' => 'Admin Kecamatan ' . $kecamatan_nama,
                    'username' => strtolower($kecamatan_nama),
                    'password' => password_hash("123456", PASSWORD_DEFAULT)
                ]))->save();
            }
            $desa_nama = $data[4];
            $desa = model(Desa::class)->where(['desa_nama' => $desa_nama, 'kecamatan_id' => $kecamatan->kecamatan_id])->first();
            if (!$desa) {
                (new EntitiesDesa(['desa_nama' => $desa_nama, 'kecamatan_id' => $kecamatan->kecamatan_id]))->save();
                $desa = model(Desa::class)->where(['desa_nama' => $desa_nama, 'kecamatan_id' => $kecamatan->kecamatan_id])->first();
            }
            $jenis_kelamin = null;
            if (in_array(trim($data[6]), ['LAKI - LAKI', 'LAKI LAKI', 'LAKI-LAKI'])) {
                $jenis_kelamin = 'L';
            }
            if ($data[6] == 'PEREMPUAN') {
                $jenis_kelamin = 'P';
            }
            $bansos_nama = $data[8];
            $jenis_bansos = model(JenisBansos::class)->where(['jenis_nama' => preg_replace('/[0-9]+/', '', $bansos_nama)])->first();
            if (!$jenis_bansos) {
                (new EntitiesJenisBansos(['jenis_nama' => preg_replace('/[0-9]+/', '', $bansos_nama)]))->save();
                $jenis_bansos = model(JenisBansos::class)->where(['jenis_nama' => preg_replace('/[0-9]+/', '', $bansos_nama)])->first();
            }
            $bansos = model(Bansos::class)->where(['bansos_nama' => $bansos_nama])->first();
            if (!$bansos) {
                (new EntitiesBansos(['bansos_nama' => $bansos_nama,'jenis_id' => $jenis_bansos->id]))->save();
                $bansos = model(Bansos::class)->where(['bansos_nama' => $bansos_nama])->first();
            }
            $warga = model(Warga::class)->where(['warga_nik' => $data[2]])->first();
            if (!$warga) {
                (new EntitiesWarga([
                    'desa_id' => $desa->desa_id,
                    'warga_nama' => $data[1],
                    'warga_nik' => $data[2],
                    'warga_rt_rw' => $data[5],
                    'warga_jk' => $jenis_kelamin,
                    'warga_usia' => (int) $data[7]
                ]))->save();

                (new BansosWarga([
                    'bansos_id' => $bansos->bansos_id,
                    'bansos_warga_nik' => $data[2],
                    'desa_id' => $desa->desa_id,
                    'warga_rt_rw' => $data[5],
                    'warga_usia' => (int) $data[7],
                    'status' => 0
                ]))->save();
            }
        }
    }
}
