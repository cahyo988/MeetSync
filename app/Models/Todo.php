<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $fillable = [
        'pesan',
        'creator_id',
        'penerima_id',
        'deadline',
        'status',];

    public function creator()
    {
        return $this->belongsTo(Employee::class, 'creator_id');
    }

    public function penerima()
    {
        return $this->belongsTo(Employee::class, 'penerima_id');
    }
}
