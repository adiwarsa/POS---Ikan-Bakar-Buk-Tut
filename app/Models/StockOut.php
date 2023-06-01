<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;
    protected $table = 'stock_out';
    protected $fillable = [
        'id_stock',
        'qty',
        'pcs',  
        'date_out',
        'description',
        'id_user',
    ];


    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }
}
