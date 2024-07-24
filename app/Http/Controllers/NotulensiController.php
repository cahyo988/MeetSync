<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Notulensi;
use App\Models\AgendaEmployee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class NotulensiController extends Controller
{
    public function view()
    {
        $agenda = Agenda::first();
        $notulensiview = Notulensi::with(['agenda', 'agenda.participants'])->get();
        return view('notulensi.notulensi-view', compact('notulensiview', 'agenda'));
    }

    public function show($id)
    {
        try {
            $notulensi = Notulensi::with(['agenda', 'agenda.participants'])->findOrFail($id);
            $ketuaRapat = $notulensi->ketuaRapat;
            $sekretarisRapat = $notulensi->sekretarisRapat;
            $semuaPesertaRapat = $notulensi->semuaPesertaRapat->filter(function ($peserta) {
                return $peserta->pivot->absensi == 1;
            });
            return view('notulensi.notulensi-details', compact('notulensi', 'ketuaRapat', 'sekretarisRapat', 'semuaPesertaRapat'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle not found exception, misalnya redirect atau tampilkan pesan kesalahan
            return redirect()->route('notulensi.view')->with('error', 'Notulensi tidak ditemukan.');
        } catch (\Exception $e) {
            // Handle exception lainnya
            return redirect()->route('notulensi.view')->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    // NotulensiController.php

    public function create($id)
    {
        $agenda = Agenda::findOrFail($id);
        $participants = AgendaEmployee::where('agenda_id', $id)
            ->with('employee')
            ->get();

        return view('notulensi.notulensi-create', compact('agenda', 'participants'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'agenda_id' => 'required|exists:agenda,id|unique:notulensi,agenda_id',
                'hasil' => 'required',
                'absensi' => 'required|array',
            ]);
            // Simpan notulensi ke database
            $notulensi = Notulensi::create([
                'agenda_id' => $request->agenda_id,
                'hasil' => $request->hasil,
            ]);
            $agenda = Agenda::find($request->agenda_id);
            $agenda->sudah_notulensi = true;
            $agenda->save();
            // Proses absensi peserta rapat
            $absensiData = $request->input('absensi', []);
            // Proses absensi peserta rapat
            $absensiData = $request->input('absensi', []);
            foreach ($absensiData as $employeeId => $isChecked) {
                // Periksa apakah checkbox dicentang (memberikan nilai "on")
                $isChecked = $isChecked === 'on' ? 1 : 0;

                // Update database
                AgendaEmployee::where('agenda_id', $request->agenda_id)
                    ->where('employee_id', $employeeId)
                    ->update(['absensi' => $isChecked]);
            }
            DB::commit();
            return redirect()->route('notulensi.view')->with('success', 'Notulensi berhasil disimpan.');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return redirect()->route('notulensi.create', ['id' => $request->agenda_id])->with('error', 'Agenda ini sudah memiliki notulensi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('notulensi.create', ['id' => $request->agenda_id])->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $agenda = Agenda::first();
        $notulensi =  Notulensi::with(['agenda', 'agenda.participants'])->findOrFail($id);
        $ketuaRapat = $notulensi->ketuaRapat;
        $sekretarisRapat = $notulensi->sekretarisRapat;
        return view('notulensi.notulensi-edit', compact('notulensi', 'agenda', 'ketuaRapat', 'sekretarisRapat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hasil' => 'required',
        ]);

        $notulensi = Notulensi::findOrFail($id);
        $notulensi->update([
            'hasil' => $request->hasil,
        ]);

        return redirect()->route('notulensi.view')->with('succes', 'Notulensi berhasil diperbarui.');
    }
}
