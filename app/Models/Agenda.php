<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Carbon;


class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'judul_rapat',
        'rencana_pembahasan',
        'ketua_rapat',
        'sekretaris_rapat',
        'peserta_rapat',
        'tanggal_rapat',
        'lokasi',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'agenda_employee', 'agenda_id', 'employee_id')->withPivot('absensi');
    }
    public function ketuaRapat(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ketua_rapat');
    }

    public function employeeSekretaris(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'sekretaris_rapat');
    }
    public function notulensi()
    {
        return $this->hasOne(Notulensi::class);
    }
};
