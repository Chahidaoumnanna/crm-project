<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
//    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'address',
        'type'
    ];
}
