<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teslabuy extends Model
{
    protected $table = 'teslabuy';

    protected $fillable = [
        'car_name',
        'car_year',
        'fullname',
        'email',
        'status',
        'price',
        'ptype',
        'transid',
        'proof',
        'dateadd',
    ];

    protected $dates = ['dateadd']; // So Laravel treats it as a Carbon date

    use HasFactory;
}
