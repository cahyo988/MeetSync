<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use illuminate\support\Facades\Auth;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class UserManagementController extends Controller
{
    // index page
    public function index()
    {
        $users = User::all();
        $employee = Employee::all();
        return view('usermanagement.list_users', compact('users', 'employee'));
    }


    public function userCreate()
    {
        $user = User::all();
        $employee = Employee::all();
        $roles = Role::all();
        return view('userManagement.create-users', compact('user', 'employee', 'roles'));
    }
    public function userEdit($username)
    {
        $user = User::where('username', $username)->first();
        $employee = Employee::all();
        $roles = Role::all();
        if ($user) {
            return view('userManagement.edit-users', compact('user', 'roles', 'employee'));
        }
        return redirect()->route('user.index')->with('error', 'User not found');
    }

    public function userUpdate(Request $request, $username)
    {
        $user = User::where('username', $username)->first();

        // Periksa apakah pengguna ditemukan
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not found');
        }

        // Tentukan aturan validasi
        $validationRules = [
            'avatar' => 'image|mimes:jpeg,png,jpg,gif',
            'nip' => 'required',
            'nama' => 'required',
            'fakultas' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'role_id' => 'required|exists:roles,id',
        ];

        // Cek apakah ada input untuk password baru
        if ($request->input('password')) {
            $validationRules['password'] = 'required';
        }

        $request->validate($validationRules);

        // Perbarui data pengguna
        $user->role_id = $request->input('role_id');

        // Mengelola pembaruan avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $avatarPath;
        }


        // Cek apakah ada input password baru
        if ($request->input('password')) {
            $validationRules['password'] = 'required';
            $user->password = bcrypt($request->input('password'));
        }

        // Perbarui data entitas employee
        $user->employee->nip = $request->input('nip');
        $user->employee->nama = $request->input('nama');
        $user->employee->fakultas = $request->input('fakultas');
        $user->employee->no_hp = $request->input('no_hp');
        $user->employee->email = $request->input('email');
        $user->employee->save();

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }



    public function userDelete($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        // Hapus user dan semua relasinya
        $user->employee()->delete();
        $user->role();
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    //////////////////////PROFILE///////////////////////////////////////////////

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan melalui formulir
        $validationRules = [
            // Tentukan aturan validasi sesuai dengan kebutuhan Anda
            'username' => 'required|unique:users',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif',
            'password' => 'required',
            'nip' => 'required',
            'nama' => 'required',
            'fakultas' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'role_id' => 'required|exists:roles,id',
        ];

        $request->validate($validationRules);

        // Mengelola unggah gambar avatar jika tersedia
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatar', 'public');
        }

        // Membuat entitas Employee
        $employee = new Employee;
        $employee->nip = $request->input('nip');
        $employee->nama = $request->input('nama');
        $employee->fakultas = $request->input('fakultas');
        $employee->no_hp = $request->input('no_hp');
        $employee->email = $request->input('email');
        $employee->save();

        // Membuat entitas User
        $user = new User;
        $user->username = $request->input('username');
        $user->avatar = $avatarPath;
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->employee_id = $employee->id;
        $user->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User and Employee created successfully');
    }


    public function myProfile()
    {
        $user = Auth::user();
        $employee = $user->employee;

        return view('dashboard.myProfile', compact('user', 'employee'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $employee = $user->employee;
        $role = $user->role;
        return view('userManagement.edit-profile', compact('user', 'employee', 'role'));
    }

    public function updateProfile(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();

            if ($user) {
                $employee = $user->employee;
                $employee->nip = $request->nip;
                $employee->nama = $request->nama;
                $employee->fakultas = $request->fakultas;
                $employee->no_hp = $request->no_hp;
                $employee->email = $request->email;
                $employee->save();

                if ($request->hasFile('avatar')) {
                    $avatarPath = $request->file('avatar')->store('avatar', 'public');
                    $user->avatar = $avatarPath;
                    $user->save();
                }

                DB::commit();
                Toastr::success('User updated successfully :)', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('User update failed :(', 'Error');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User update failed :(', 'Error');
        }

        return redirect()->route('user.profile.page')->with('success', 'Profile updated successfully');
    }


    /** change password */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->username)->update(['password' => Hash::make($request->new_password)]);

        Toastr::success('Password updated successfully', 'Success');
        return redirect()->intended('home');
    }
}
