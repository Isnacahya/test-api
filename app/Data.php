<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderDetail;

class Data extends Model
{
    //
    protected $table = 'data';

    protected $fillable = ['orderId', 'invoiceNumber', 'orderName', 'orderDetail',
                            'orderDescription', 'createBy', 'updateBy'];



}
