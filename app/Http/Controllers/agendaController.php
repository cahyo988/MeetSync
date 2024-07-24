<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\AgendaReminder;

class agendaController extends Controller
{
    public function agendaCreate()
    {
        $users = User::all();

        return view('agenda.agenda-create', compact('users'));
    }

    public function agendaStore(Request $request)
    {
        $request->validate([
            'judul_rapat' => 'required',
            'rencana_pembahasan' => 'required',
            'tanggal_rapat' => 'required',
            'lokasi' => 'required',
            'ketua_rapat' => 'required',
            'sekretaris_rapat' => 'required',
            'fakultas' => 'array', // Either fakultas or peserta_rapat must be filled
            'peserta_rapat' => 'array', // Either fakultas or peserta_rapat must be filled
        ]);

        // Simpan agenda
        $agenda = Agenda::create([
            'judul_rapat' => $request->judul_rapat,
            'rencana_pembahasan' => $request->rencana_pembahasan,
            'tanggal_rapat' => $request->tanggal_rapat,
            'lokasi' => $request->lokasi,
            'ketua_rapat' => $request->ketua_rapat,
            'sekretaris_rapat' => $request->sekretaris_rapat,
        ]);

        // Initialize peserta rapat as an empty array if null
        $pesertaRapat = $request->peserta_rapat ?? [];

        // Attach ketua_rapat and sekretaris_rapat to the peserta_rapat array
        $pesertaRapat = array_merge($pesertaRapat, [$request->ketua_rapat, $request->sekretaris_rapat]);

        // If checkbox "FTIB" is checked, add all FTIB employees except ketua_rapat and sekretaris_rapat
        if (in_array('FTIB', $request->fakultas ?? [])) {
            $ftibParticipants = User::whereHas('employee', function ($query) {
                $query->where('fakultas', 'FTIB');
            })->whereNotIn('employee_id', [$request->ketua_rapat, $request->sekretaris_rapat])->pluck('employee_id')->toArray();
            $pesertaRapat = array_merge($pesertaRapat, $ftibParticipants);
        }

        // If checkbox "FTEIC" is checked, add all FTEIC employees except ketua_rapat and sekretaris_rapat
        if (in_array('FTEIC', $request->fakultas ?? [])) {
            $fteicParticipants = User::whereHas('employee', function ($query) {
                $query->where('fakultas', 'FTEIC');
            })->whereNotIn('employee_id', [$request->ketua_rapat, $request->sekretaris_rapat])->pluck('employee_id')->toArray();
            $pesertaRapat = array_merge($pesertaRapat, $fteicParticipants);
        }
        // Remove duplicate values (if any)
        $pesertaRapat = array_unique($pesertaRapat);

        // Attach participants
        $agenda->participants()->attach($pesertaRapat);

        return redirect()->route('agenda.view')->with('success', 'Agenda berhasil ditambahkan.');
    }




    public function myAgendas()
    {
        $user = auth()->user();
        $employee = Employee::find($user->employee_id);
        $attendedAgendas = $employee->attendedAgendas()->with('notulensi')->get();

        return view('agenda.agenda-view', compact('attendedAgendas'));
    }

    public function confirm(Agenda $agenda)
    {
        // Ambil informasi ketua rapat dari kolom "ketua_rapat" dalam tabel "agenda"
        $ketuaRapat = $agenda->ketua_rapat;

        // Verifikasi apakah pengguna adalah ketua rapat atau memiliki izin untuk mengkonfirmasi
        $user = auth()->user();

        if ($user->employee_id == $ketuaRapat) {
            $agenda->status = true; // Menandai agenda sebagai dikonfirmasi
            $agenda->save();


            return redirect()->route('agenda.view')->with('success', 'Agenda telah dikonfirmasi.');
        } else {
            return redirect()->route('agenda.view')->with('error', 'Anda tidak memiliki izin untuk mengkonfirmasi agenda.');
        }
    }

    public function destroy(Agenda $agenda)
    {
        $ketuaRapat = $agenda->ketua_rapat;
        $user = auth()->user();

        if ($user->employee_id == $ketuaRapat) {
            if ($agenda->notulensi) {
                $agenda->notulensi->delete();
            }
            $agenda->delete();

            return redirect()->route('agenda.view')->with('delete', 'Konfirmasi agenda dan notulensi terkait dibatalkan.');
        } else {
            return redirect()->route('agenda.view')->with('error', 'Anda tidak memiliki izin untuk membatalkan konfirmasi agenda.');
        }
    }

    public function agendaEdit($id)
    {
        $agenda = Agenda::find($id);
        if (auth()->user()->employee_id == $agenda->ketua_rapat) {
            return view('agenda.agenda-edit', compact('agenda'));
        } else {
            return redirect()->route('agenda.view')->with('error', 'Anda tidak memiliki izin untuk mengedit agenda ini.');
        }
    }



    public function agendaUpdate(Request $request, $id)
    {
        $agenda = Agenda::find($id);
        if (auth()->user()->employee_id == $agenda->ketua_rapat) {
            $validatedData = $request->validate([
                'judul_rapat' => 'required|max:255',
                'rencana_pembahasan' => 'required',
                'tanggal_rapat' => 'required|date',
                'lokasi' => 'required|max:255',
            ]);
            $agenda->judul_rapat = $validatedData['judul_rapat'];
            $agenda->rencana_pembahasan = $validatedData['rencana_pembahasan'];
            $agenda->tanggal_rapat = $validatedData['tanggal_rapat'];
            $agenda->lokasi = $validatedData['lokasi'];

            $agenda->save();

            return redirect()->route('agenda.view')->with('success', 'Agenda berhasil diperbarui.');
        } else {
            return redirect()->route('agenda.view')->with('error', 'Anda tidak memiliki izin untuk memperbarui agenda ini.');
        }
    }
    public function agendaShow($id)
    {
        $agenda = Agenda::with(['ketuaRapat', 'employeeSekretaris', 'participants'])->findOrFail($id);

        // dd($agenda->employee);

        // Cek apakah pengguna memiliki hak akses ke detail agenda
        if (
            Auth::user()->employee_id == $agenda->ketua_rapat ||
            Auth::user()->employee_id == $agenda->sekretaris_rapat ||
            $agenda->participants->contains(Auth::user()->employee_id)
        ) {
            return view('agenda.agenda-details', compact('agenda'));
        } else {
           
            abort(403, 'Unauthorized action.');
        }
    }
    public function sendReminderEmail($agendaId)
    {
        try {
            $agenda = Agenda::find($agendaId);
            $participants = $agenda->participants;

            foreach ($participants as $participant) {
                // Kirim email pengingat
                Mail::to($participant->email)->send(new AgendaReminder($agenda));
            }

            return redirect()->route('agenda.view')->with('success', 'Pengingat telah berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->route('agenda.view')->with('error', 'Gagal mengirim pengingat. Silakan coba lagi.');
        }
    }
}
