<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
        });

        $roles = [
            'Admin', 'Rektor', 'Senat Institusi', 'Dewan Penasehat', 'Bagian Sekretariat HUMAS dan KERJASAMA',
            'Bagian Penjaminan Mutu dan Perencanaan', 'Wakil Rektor 1', 'Wakil Rektor 2', 'Wakil Rektor 3',
            'Bagian Akademik', 'Bagian Lembaga Penelitian dan Pengabdian Masyarakat', 'Bagian Sumber Daya Manusia',
            'Bagian Keuangan', 'Bagian Pusat Teknologi Informasi', 'Bagian Logistik dan Manajemen Aset',
            'Bagian Admisi dan Marketing', 'Bagian Kemahasiswaan', 'Dekan FTEIC', 'Dekan FTIB', 'Urusan Administrasi Akademik',
            'Urusan Pengembangan Akademik', 'Urusan Pusat Bahasa dan Perpustakaan', 'Urusan Penelitian dan Publikasi',
            'Urusan Pengabdian Masyarakat', 'Urusan Technology Transfer Office', 'Urusan Pelayanan SDM', 'Urusan Pengembangan SDM', 'Urusan Anggaran dan Pembendaharaan',
            'Urusan Akuntansi dan Layanan', 'Urusan Infrastruktur dan Platform', 'Urusan Aplikasi', 'Layanan IT',
            'Urusan Logistik', 'Urusan Manajemen Aset', 'Urusan Admisi dan Data', 'Urusan Marketing', 'Urusan Aktivitas Kemahasiswaan',
            'Urusan Pengembangan Karier dan Alumni', 'Urusan Pusat Layanan', 'Urusan Sekretaris Pimpinan',
            'Urusan Hubungan Masyarakat', 'Urusan Legal Kerjasama dan International Office',
            'Urusan Penjaminan & Analisis Mutu', 'Urusan Perencanaan & Performansi', 'Urusan Internal Audit',
            'Wakil Dekan FTIB', 'Urusan Administrasi Akademik & Kemahasiswaan FTIB', 'Urusan Administrasi Umum FTIB',
            'Urusan Laboratorium FTIB', 'Kaprodi S1 Sistem Informasi', 'Kaprodi S1 Teknologi Informasi',
            'Kaprodi S1 Rekayasa Perangkat Lunak', 'Kaprodi S1 Informatika', 'Kaprodi S1 Sains Data',
            'Kaprodi S1 Bisnis Digital', 'Kelompok Keahlian FTIB', 'Wakil Dekan FTEIC',
            'Urusan Administrasi Akademik & Kemahasiswaan FTEIC', 'Urusan Administrasi Umum FTEIC',
            'Urusan Laboratorium FTEIC', 'Kaprodi S1 Teknik Elektro', 'Kaprodi S1 Teknik Telekomunikasi',
            'Kaprodi S1 Teknik Komputer', 'Kaprodi S1 Teknik Industri', 'Kaprodi S1 Teknik Logistik',
            'Kelompok Keahlian FTEIC', 'Dosen Sistem Informasi', 'Dosen Teknologi Informasi', 'Dosen Rekayasa Perangkat Lunak',
            'Dosen Informatika', 'Dosen Sains Data', 'Dosen Bisnis Digital', 'Dosen Teknik Elektro',
            'Dosen Teknik Telekomunikasi', 'Dosen Teknik Komputer', 'Dosen Teknik Industri',
            'Dosen Teknik Logistik',
        ];

        DB::table('roles')->insert(array_map(function ($role) {
            return ['role' => $role];
        }, $roles));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
