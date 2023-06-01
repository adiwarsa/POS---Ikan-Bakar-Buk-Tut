<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'code',
        'id_user',
        'name',
        'total_price',
        'pay',
    ];

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'detail_transaction')->withPivot('qty', 'price');
    }

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'detail_transaction')->withPivot('qty', 'price');
    }

}
