<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $fillable = [
        'nama',
        'telp',
    ];

    public function stockin()
    {
        return $this->hasMany(StockIn::class);
    }
}
