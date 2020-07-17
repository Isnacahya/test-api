<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;

class OrderDetailController extends Controller
{
    //
    public function getAllData(){
        $data = OrderDetail::get()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);

    }


}
