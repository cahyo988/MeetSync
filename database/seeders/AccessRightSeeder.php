<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccessRight;
use App\Models\AccessRights;

class AccessRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            //Rektor
            ['role_id_atasan' => 2, 'role_id_bawahan' => 3],//rektor Senat Institusi
            ['role_id_atasan' => 2, 'role_id_bawahan' => 4],//rektor Dewan Penasehat
            ['role_id_atasan' => 2, 'role_id_bawahan' => 5],//rektor bagian sekretariat humas
            ['role_id_atasan' => 2, 'role_id_bawahan' => 6],// Bagian Penjaminan Mutu dan Perencanaan
            ['role_id_atasan' => 2, 'role_id_bawahan' => 7],// rektor Wakil Rektor 1
            ['role_id_atasan' => 2, 'role_id_bawahan' => 8],// rektor Wakil Rektor 2
            ['role_id_atasan' => 2, 'role_id_bawahan' => 9],// rektor Wakil Rektor 3
            ['role_id_atasan' => 2, 'role_id_bawahan' => 18],// rektor FTEIC
            ['role_id_atasan' => 2, 'role_id_bawahan' => 19],// rektor FTIB

            //bagian sekretariat humas
            ['role_id_atasan' => 5, 'role_id_bawahan' => 40],//rektor bagian sekretariat humas
            ['role_id_atasan' => 5, 'role_id_bawahan' => 41],//sekpim
            ['role_id_atasan' => 5, 'role_id_bawahan' => 42],//hub legal

            //bagian peminjaman mutu
            ['role_id_atasan' => 6, 'role_id_bawahan' => 43],//pinjaman
            ['role_id_atasan' => 6, 'role_id_bawahan' => 44],//perencanaan
            ['role_id_atasan' => 6, 'role_id_bawahan' => 45],//internal audit

            //BAGIAN WAREK 1 dan bawahan bawahannya
            ['role_id_atasan' => 7, 'role_id_bawahan' => 10],// warek 1 Bagian Akademik
            ['role_id_atasan' => 7, 'role_id_bawahan' => 11],// warek 1 Bagian Lembaga Penelitian dan Pengabdian Masyarakat
            ['role_id_atasan' => 7, 'role_id_bawahan' => 20],// warek 1 
            ['role_id_atasan' => 7, 'role_id_bawahan' => 21],// warek 1 
            ['role_id_atasan' => 7, 'role_id_bawahan' => 22],// warek 1 
            ['role_id_atasan' => 7, 'role_id_bawahan' => 23],// warek 1 
            ['role_id_atasan' => 7, 'role_id_bawahan' => 24],// warek 1
            ['role_id_atasan' => 10, 'role_id_bawahan' => 20],//  Bagian Akademik
            ['role_id_atasan' => 10, 'role_id_bawahan' => 21],//  Bagian Akademik
            ['role_id_atasan' => 10, 'role_id_bawahan' => 22],//  Bagian Akademik
            ['role_id_atasan' => 11, 'role_id_bawahan' => 23],//  Bagian Lembaga Penelitian dan Pengabdian Masyarakat
            ['role_id_atasan' => 11, 'role_id_bawahan' => 24],//  Bagian Lembaga Penelitian dan Pengabdian Masyarakat
            ['role_id_atasan' => 11, 'role_id_bawahan' => 25],//  Bagian Lembaga Penelitian dan Pengabdian Masyarakat


            //Warek 2 dan bawahannya
            ['role_id_atasan' => 8, 'role_id_bawahan' => 12],// warek 2 SDM
            ['role_id_atasan' => 8, 'role_id_bawahan' => 13],// warek 2 KEUANGAN
            ['role_id_atasan' => 8, 'role_id_bawahan' => 14],// warek 2 PUTI 
            ['role_id_atasan' => 8, 'role_id_bawahan' => 15],// warek 2 LOGISTIK
            ['role_id_atasan' => 8, 'role_id_bawahan' => 26],// warek 2 pelayanan sdm
            ['role_id_atasan' => 8, 'role_id_bawahan' => 27],// warek 2 pengembangan sdm
            ['role_id_atasan' => 8, 'role_id_bawahan' => 28],// warek 2 anggaran 
            ['role_id_atasan' => 8, 'role_id_bawahan' => 29],// warek 2 akuntansi
            ['role_id_atasan' => 8, 'role_id_bawahan' => 30],// warek 2
            ['role_id_atasan' => 8, 'role_id_bawahan' => 31],// warek 2
            ['role_id_atasan' => 8, 'role_id_bawahan' => 32],// warek 2 
            ['role_id_atasan' => 8, 'role_id_bawahan' => 33],// warek 2 
            ['role_id_atasan' => 8, 'role_id_bawahan' => 34],// warek 2
            ['role_id_atasan' => 12, 'role_id_bawahan' => 26],// SDM
            ['role_id_atasan' => 12, 'role_id_bawahan' => 27],// SDM
            ['role_id_atasan' => 13, 'role_id_bawahan' => 28],// KEUANGAN
            ['role_id_atasan' => 13, 'role_id_bawahan' => 29],// KEUANGAN
            ['role_id_atasan' => 14, 'role_id_bawahan' => 30],// PUTI
            ['role_id_atasan' => 14, 'role_id_bawahan' => 31],// PUTI
            ['role_id_atasan' => 14, 'role_id_bawahan' => 32],// PUTI
            ['role_id_atasan' => 15, 'role_id_bawahan' => 33],// Logistik
            ['role_id_atasan' => 15, 'role_id_bawahan' => 34],// Logistik

            //warek 3 dan bawahannya
            ['role_id_atasan' => 9, 'role_id_bawahan' => 16],// warek 3 ADMISI
            ['role_id_atasan' => 9, 'role_id_bawahan' => 17],// warek 3 KEMAHASISWAAN
            ['role_id_atasan' => 9, 'role_id_bawahan' => 35],// warek 3 
            ['role_id_atasan' => 9, 'role_id_bawahan' => 36],// warek 3 
            ['role_id_atasan' => 9, 'role_id_bawahan' => 37],// warek 3 
            ['role_id_atasan' => 9, 'role_id_bawahan' => 38],// warek 3 
            ['role_id_atasan' => 9, 'role_id_bawahan' => 39],// warek 3 
            ['role_id_atasan' => 16, 'role_id_bawahan' => 35],// warek 3 
            ['role_id_atasan' => 16, 'role_id_bawahan' => 36],// warek 3 
            ['role_id_atasan' => 17, 'role_id_bawahan' => 37],// warek 3 
            ['role_id_atasan' => 17, 'role_id_bawahan' => 38],// warek 3 
            ['role_id_atasan' => 17, 'role_id_bawahan' => 39],// warek 3 

            //Dekan FTIB DAN BAWAHANNYA
            ['role_id_atasan' => 19, 'role_id_bawahan' => 46],//wakildekan
            ['role_id_atasan' => 19, 'role_id_bawahan' => 47],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 48],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 49],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 50],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 51],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 52],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 53],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 54],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 55],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 56],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 67],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 68],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 69],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 70],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 71],//
            ['role_id_atasan' => 19, 'role_id_bawahan' => 72],//
            ['role_id_atasan' => 46, 'role_id_bawahan' => 47],//acces wakil dekan
            ['role_id_atasan' => 46, 'role_id_bawahan' => 48],//
            ['role_id_atasan' => 46, 'role_id_bawahan' => 49],//
            ['role_id_atasan' => 50, 'role_id_bawahan' => 67],//acces kaprodi si 
            ['role_id_atasan' => 51, 'role_id_bawahan' => 68],//acces kaprodi TI 
            ['role_id_atasan' => 52, 'role_id_bawahan' => 69],// acces kaprodi RPL 
            ['role_id_atasan' => 53, 'role_id_bawahan' => 70],//acces kaprodi INFORMATIKA 
            ['role_id_atasan' => 54, 'role_id_bawahan' => 71],//acces kaprodi SAINS DATA
            ['role_id_atasan' => 55, 'role_id_bawahan' => 72],//acces kaprodi BISDIG

            //Dekan FTEIC DAN BAWAHANNYA
            ['role_id_atasan' => 18, 'role_id_bawahan' => 57],//wakildekan
            ['role_id_atasan' => 18, 'role_id_bawahan' => 58],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 59],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 60],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 61],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 62],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 63],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 64],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 65],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 66],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 73],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 74],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 75],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 76],//
            ['role_id_atasan' => 18, 'role_id_bawahan' => 77],//
            ['role_id_atasan' => 57, 'role_id_bawahan' => 58],//acces wakil dekan
            ['role_id_atasan' => 57, 'role_id_bawahan' => 59],//
            ['role_id_atasan' => 57, 'role_id_bawahan' => 60],//
            ['role_id_atasan' => 61, 'role_id_bawahan' => 73],//acces kaprodi te 
            ['role_id_atasan' => 62, 'role_id_bawahan' => 74],//acces kaprodi tt 
            ['role_id_atasan' => 63, 'role_id_bawahan' => 75],// acces kaprodi tk 
            ['role_id_atasan' => 64, 'role_id_bawahan' => 76],//acces kaprodi ti 
            ['role_id_atasan' => 65, 'role_id_bawahan' => 77],//acces kaprodi tl
          
        ];

        foreach ($data as $accessRightData) {
            $accessRight = new AccessRights();
            $accessRight->role_id_atasan = $accessRightData['role_id_atasan'];
            $accessRight->role_id_bawahan = $accessRightData['role_id_bawahan'];
            $accessRight->save();
        }
    }
}
