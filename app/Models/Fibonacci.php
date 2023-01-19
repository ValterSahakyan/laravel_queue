<?php

namespace App\Models;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fibonacci extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'result',
        'status',
    ];
}
