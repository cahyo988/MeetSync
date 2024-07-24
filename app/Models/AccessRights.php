<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessRights extends Model
{
    use HasFactory;

    protected $table = 'access_rights';
    public $timestamps = false;
    protected $fillable = [
        'role_id_atasan',
        'role_id_bawahan',
    ];

    public function roleAtasan()
    {
        return $this->belongsTo(Role::class, 'role_id_atasan');
    }

    public function roleBawahan()
    {
        return $this->belongsTo(Role::class, 'role_id_bawahan');
    }
    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
