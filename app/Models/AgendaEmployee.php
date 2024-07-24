<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaEmployee extends Model
{
    public $timestamps = false;
    protected $table = 'agenda_employee';
    protected $fillable = [
        'agenda_id',
        'employee_id',
        'absensi',
    ];
    // Relasi dengan model Employee
    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    
    // Relasi dengan model Agenda
    public function agenda():BelongsTo
    {
        return $this->belongsTo(Agenda::class);
    }
}
