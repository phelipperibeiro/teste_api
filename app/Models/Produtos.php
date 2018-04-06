<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{

    protected $fillable = [
        'lm',
        'name',
        'free_shipping',
        'description',
        'price',
    ];

}
