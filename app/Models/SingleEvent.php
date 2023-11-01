<?php

namespace App\Models;

use App\Enum\EventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'date',
        'status',
        'type',
        'user_id',
    ];
    protected $casts = [
        'date' => 'datetime',
        'status' => EventStatus::class,
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
