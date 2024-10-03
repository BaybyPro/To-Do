<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'date'
    ];

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($task) {
            $task->date = now()->toDateString();
        });
    }
}
