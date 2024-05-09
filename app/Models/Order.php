<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [

        'customer_id',

        'user_id',

        'menu_id',

        'price',

        'quantity',

        'status'

    ];
    public function menu()
    {
        return $this->belongsTo(Menu_Items::class);
    }
}
