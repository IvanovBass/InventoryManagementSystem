<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payment(){
        return $this->belongsTo(Payment::class,'id','invoice_no');
    }

    public function invoice_details(){
        return $this->hasMany(InvoiceDetail::class,'invoice_no','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
