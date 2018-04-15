<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $table = 'produto';
    
    protected $fillable = [
        'lm',
        'name',
        'free_shipping',
        'description',
        'price',
    ];
    

}
