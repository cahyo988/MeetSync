<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nip',
        'nama',
        'fakultas',
        'no_hp',
        'email',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function attendedAgendas(): BelongsToMany
    {
        return $this->belongsToMany(Agenda::class, 'agenda_employee', 'employee_id', 'agenda_id');
    }
    public function semuaNotulensi()
    {
        return $this->belongsToMany(Notulensi::class, 'agenda_employee', 'employee_id', 'agenda_id')
            ->withPivot('absensi');
    }
    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
