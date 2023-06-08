<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stock';
    protected $fillable = [
        'code', 
        'name', 
        'type',
        'limits',
        'qty', 
        'qtytype',
        'image',
        'remind',
    ];

    public function foods()
    {
        return $this->hasMany(Menu::class);
    }

    public function stockins()
    {
        return $this->hasMany(StockIn::class);
    }

    public function stockouts()
    {
        return $this->hasMany(StockIn::class);
    }
}
