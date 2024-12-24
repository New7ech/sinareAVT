<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'compagnie_id',
        'mensuels_id',
        'formulairebars_id',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mensuel()
    {
        return $this->belongsTo(Mensuel::class, 'mensuels_id');
    }
    public function formulairebar()
    {
        return $this->belongsTo(Formulairebar::class, 'formulairebars_id');
    }
    public function getIsReadAttribute()
    {
        return !is_null($this->read_at);
    }
}
