<?php

namespace App\Models;

// app/Models/Notulensi.php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notulensi extends Model
{
    use HasFactory;

    protected $table = 'notulensi';

    protected $fillable = [
        'agenda_id',
        'hasil',
        
    ];


    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }

    public function ketuaRapat(): BelongsTo
    {
        return $this->agenda->belongsTo(Employee::class, 'ketua_rapat', 'id');
    }

    public function sekretarisRapat(): BelongsTo
    {
        return $this->agenda->belongsTo(Employee::class, 'sekretaris_rapat', 'id');
    }

    public function semuaPesertaRapat(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'agenda_employee', 'agenda_id', 'employee_id')
            ->withPivot('absensi');
    }
    
}
