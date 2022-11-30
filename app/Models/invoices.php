<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;////////////////////////////////

class invoices extends Model
{


    use SoftDeletes;//////////////////////////////
    use HasFactory;
protected $guarded=[];
    // protected $fillable=[

    //     'invoice_number',
    //     'invoice_date',
    //     'due_date',
    //     'product',
    //     'section',
    //     'discount',
    //     'rate_vat',
    //     'value_vat',
    //     'total',
    //     'status',
    //     'value_status',
    //     'note' ,
    //     'user'
    // ];


    protected function section()
    {
        return $this->belongsTo(sections::class);
    }
}
