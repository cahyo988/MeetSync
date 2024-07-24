<?php

// app/Http/Controllers/AccessRightController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRights;
use App\Models\Role;


class AccessRightController extends Controller
{
    // Menampilkan daftar hak akses
    public function index()
    {
        $accessRights = AccessRights::all();
        return view('access_rights.index', compact('accessRights'));
    }

    // Menampilkan formulir untuk membuat hak akses baru
    public function create()
    {
        // Mengambil data roles
        $roles = Role::all();
        return view('access_rights.create', compact('roles'));
    }

    // Menyimpan hak akses baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'role_id_atasan' => 'required|exists:roles,id',
            'role_id_bawahan' => 'required|array',
        ]);

        $roleAtasan = $request->role_id_atasan;
        $roleBawahanArray = $request->role_id_bawahan;

        // Create a new AccessRights instance for each role_id_bawahan
        foreach ($roleBawahanArray as $roleBawahan) {
            AccessRights::create([
                'role_id_atasan' => $roleAtasan,
                'role_id_bawahan' => $roleBawahan,
            ]);
        }

        return redirect()->route('access_rights.index')->with('success', 'Hak Akses berhasil ditambahkan.');
    }




    // Menampilkan formulir untuk mengedit hak akses
    public function edit(AccessRights $accessRight)
    {
        $roles = Role::all();
        return view('access_rights.edit', compact('accessRight', 'roles'));
    }

    // Menyimpan perubahan hak akses ke database
    public function update(Request $request, AccessRights $accessRight)
    {
        $request->validate([
            'role_id_atasan' => 'required|exists:roles,id',
            'role_id_bawahan' => 'required|exists:roles,id',
        ]);

        $accessRight->update($request->all());

        return redirect()->route('access_rights.index')->with('success', 'Hak Akses berhasil diperbarui.');
    }

    // Menghapus hak akses dari database
    public function destroy(AccessRights $accessRight)
    {
        $accessRight->delete();

        return redirect()->route('access_rights.index')->with('success', 'Hak Akses berhasil dihapus.');
    }
}
