<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function foods()
    {
        return $this->belongsToMany(Menu::class)->withPivot('qty');
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
