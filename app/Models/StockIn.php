<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;
    protected $table = 'stock_in';
    protected $fillable = [
        'id_stock',
        'id_supplier',
        'id_user',
        'qty', 
        'pcs',
        'price', 
        'total_price', 
        'file',
        'date_in',
        'supplier',
        'telp_supplier',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
