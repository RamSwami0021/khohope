<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_Items extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',

        'categorie_id',
        'supcategorie_id',

        'name',

        'description',

        'price',

        'image_url',

        'type',

        'status'

    ];
}
