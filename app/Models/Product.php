<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name',
        'Description',
        'CategoryID',
        'SupplierID',
        'Price',
        'Image',
        'Reference',
        'Quantity',
        'MinimumQty',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'CategoryID','id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'SupplierID','id');
    }
}
