<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Faker\Factory as Faker;
use App\Models\Role;

class CombinedSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $data = [
            ['username' => 'helmy','nip' => 19790001, 'nama' => 'Dr. Helmy Widyantara, S.Kom., M.Eng.', 'fakultas' => 'FTIB', 'email' => 'helmywid@ittelkom-sby.ac.id', 'role' => 19],
            ['username' => 'khodijah','nip' => 19920005, 'nama' => 'Khodijah Amiroh, S.ST., M.T.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 68],
            ['username' => 'ully','nip' => 19900008, 'nama' => 'Ully Asfari, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 40],
            ['username' => 'fidi','nip' => 19870004, 'nama' => 'Fidi Wincoko Putro, S.ST., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 52],
            ['username' => 'farah','nip' => 20870006, 'nama' => 'Farah Zakiyah Rahmanti, S.ST., M.T.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 68],
            ['username' => 'dominggo','nip' => 19900005, 'nama' => 'Dominggo Bayu Baskara, S.T., M.MT.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 72],
            ['username' => 'billy','nip' => 20870004, 'nama' => 'Billy Montolalu, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 69],
            ['username' => 'yupit','nip' => 20860017, 'nama' => 'Yupit Sudianto, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => 'yupit@ittelkom-sby.ac.id', 'role' => 46],
            ['username' => 'arliyanti','nip' => 19910003, 'nama' => 'Arliyanti Nurdin, S.T., M.T.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 68],
            ['username' => 'noerma','nip' => 19900003, 'nama' => 'Noerma Pudji Istyanto, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 17],
            ['username' => 'philip','nip' => 19940002, 'nama' => 'Philip Tobianto Daely, S.T., M.Eng., Ph.D.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 68],
            ['username' => 'oktavia','nip' => 19900006, 'nama' => 'Oktavia Ayu Permata, S.T., M.T.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 68],
            ['username' => 'sholik','nip' => 19810001, 'nama' => 'Mohammad Sholik, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 69],
            ['username' => 'dewi','nip' => 20940001, 'nama' => 'Dewi Rahmawati, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 69],
            ['username' => 'titus','nip' => 20860014, 'nama' => 'Titus Kristanto, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 72],
            ['username' => 'hawwin','nip' => 20920039, 'nama' => 'Hawwin Mardhiana, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 50],
            ['username' => 'ardian','nip' => 18920109, 'nama' => 'Ardian Yusuf Wicaksono, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 70],
            ['username' => 'bernandus','nip' => 18920108, 'nama' => 'Bernadus Anggo Seno Aji, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 51],
            ['username' => 'rokhmatul','nip' => 19890003, 'nama' => 'Rokhmatul Insani, S.T., M.T.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 21],
            ['username' => 'nasrul','nip' => 20900016, 'nama' => 'Muhamad Nasrullah, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 67],
            ['username' => 'adzanil','nip' => 22940040, 'nama' => 'Adzanil Rachmadhi Putra, S.Kom., M.Kom.', 'fakultas' => 'FTIB', 'email' => '', 'role' => 67],
            ['username' => 'admin','nip' => 99999999, 'nama' => 'admin', 'fakultas' => 'admin', 'email' => $faker->unique()->safeEmail, 'role' => 1],//
            // FTEIC
            ['username' => 'lora','nip' => 19920004, 'nama' => 'Lora Khaula Amifia, S.Pd., M.Eng.', 'fakultas' => 'FTEIC', 'email' => '', 'role' => 61],
            ['username' => 'iskandar','nip' => 19880005, 'nama' => 'Moch. Iskandar Riansyah, S.ST., M.T.', 'fakultas' => 'FTEIC', 'email' => '', 'role' => 73],
            ['username' => 'anifatul','nip' => 19920003, 'nama' => 'Anifatul Faricha, S.T., M.Sc.', 'fakultas' => 'FTEIC', 'email' => '', 'role' => 73],
            ['username' => 'isa','nip' => 19920002, 'nama' => 'Isa Hafidz, S.T., M.T.', 'fakultas' => 'FTEIC', 'email' => '', 'role' => 73],
            ['username' => 'chaironi','nip' => 20900019, 'nama' => 'Chaironi Latif, S.Si.', 'fakultas' => 'FTEIC', 'email' => '', 'role' => 73],
            ['username' => 'susijanto','nip' => 22730002, 'nama' => 'Dr. Susijanto Tri Rasmana, S.Kom., M.T.', 'fakultas' => 'FTEIC', 'email' => '', 'role' => 73],
        ];

        foreach ($data as $employeeData) {
            $employee = new Employee();
            $employee->nip = $employeeData['nip'];
            $employee->nama = $employeeData['nama'];
            $employee->fakultas = $employeeData['fakultas'];
            $employee->email = $employeeData['email'];
            $employee->no_hp = $faker->randomNumber(9, true);
            $employee->save();

          
            $role = Role::find($employeeData['role']);

            if ($role) {
                $user = new User();
                $user->username = $employeeData['username'];
                $user->avatar = 'avatar/profil.png';
                $user->password = bcrypt('password');
                $user->role_id = $role->id;
                $user->employee_id = $employee->id;
                $user->remember_token = $faker->randomAscii;
                $user->save();
            } else {
               
                $this->command->error("Role not found for: {$employeeData['role']}");
            }
        }
    }
}
