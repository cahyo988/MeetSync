<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function userProfile()
    {
        return view('dashboard.profile');
    }
    public function index()
    {
        $user = auth()->user();
        $employeeId = $user->employee_id;

        // Ambil semua agenda yang dihadiri oleh employee yang login
        $attendedAgendas = Agenda::whereHas('participants', function ($query) use ($employeeId) {
            $query->where('employee_id', $employeeId);
        })->get();

        // Hitung total agenda yang dihadiri
        $totalAgenda = $attendedAgendas->count();

        // Hitung total agenda yang sudah dikonfirmasi dan yang masih menunggu konfirmasi
        $acceptedAgenda = $attendedAgendas->where('status', true)->count();
        $waitingAgenda = $attendedAgendas->where('status', false)->count();

        $todos = Todo::where('penerima_id', $employeeId)
                ->get();
        $totalTodo = $todos->where('penerima_id', $employeeId)->count();
        $completedTodo = $todos->where('penerima_id', $employeeId)->where('status', 'selesai')->count();
        $uncompletedTodo = $todos->where('penerima_id', $employeeId)->where('status', 'belum_selesai')->count();

        $totalUser = User::count(); 

        return view('dashboard.home', compact('totalAgenda', 'waitingAgenda', 'acceptedAgenda', 'totalTodo', 'completedTodo', 'uncompletedTodo', 'totalUser'));
    }
}
