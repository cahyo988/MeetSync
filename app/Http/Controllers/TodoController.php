<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Todo;
use App\Models\AccessRights;
use App\Mail\TodoReminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        $employeeId = auth()->user()->employee->id;
        $employeeRoleId = auth()->user()->employee->user->role_id;
        $subordinateRoleIds = AccessRights::where('role_id_atasan', $employeeRoleId)
            ->pluck('role_id_bawahan')
            ->toArray();
        $subordinateRoleIds[] = $employeeRoleId;

        $todos = Todo::with(['creator', 'penerima'])
            ->where(function ($query) use ($employeeId, $subordinateRoleIds) {
                $query->whereIn('creator_id', array_merge([$employeeId], $subordinateRoleIds))
                    ->orWhereIn('penerima_id', array_merge([$employeeId], $subordinateRoleIds));
            })
            ->orWhere('creator_id', $employeeId)
            ->orWhereHas('creator.user', function ($query) use ($subordinateRoleIds) {
                $query->whereIn('role_id', $subordinateRoleIds);
            })
            ->get();

        return view('todo.index', compact('todos'));
    }
    public function create()
    {
        $employees = Employee::with('role')->get();
        return view('todo.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required',
            'creator_id' => 'required|exists:employees,id',
            'penerima_id' => 'required|exists:employees,id',
            'deadline' => 'required',
            'status' => 'in:belum_selesai,selesai',
        ]);

        Todo::create($request->all());

        return redirect()->route('todo.index')->with('success', 'Todo berhasil ditambahkan.');
    }

    public function edit(Todo $todo)
    {
        $employees = Employee::all();
        return view('todo.edit', compact('todo', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'creator_id' => 'required',
            'pesan' => 'required',
            'penerima_id' => 'required',
            'deadline' => 'required',
            'status' => 'in:belum_selesai,selesai',
        ]);
        $todo = Todo::findOrFail($id);
        $todo->update([
            'creator_id' => $request->creator_id,
            'pesan' => $request->pesan,
            'penerima_id' => $request->penerima_id,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo berhasil diperbarui.');
    }





    protected function sendReminderEmail(Todo $todo)
    {
        $employee = $todo->penerima;
        if ($employee && $employee->email) {
            Mail::to($employee->email)->send(new TodoReminder($todo));
            return redirect()->route('todo.index')->with('success', 'Reminder berhasil dikirim ke ' . $employee->nama . ' (' . $employee->email . ').');
        }
        return redirect()->route('todo.index')->with('error', 'Gagal mengirim reminder. Alamat email tidak tersedia.');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todo.index')->with('success', 'Todo berhasil dihapus.');
    }
}
