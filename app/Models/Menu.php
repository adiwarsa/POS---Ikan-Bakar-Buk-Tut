<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = [
        'id_stock',
        'name',
        'price',
        'type',
        'jenis',
        'for',
        'needqty', 
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }
    public function pakets()
    {
        return $this->belongsToMany(Paket::class)->withPivot('qty');
    }
    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}