<?php

namespace App\Http\Controllers;

use App\Data;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class ApiController extends Controller
{
    //
    public function getAllData(){
        $data = Data::get()->toJson(JSON_PRETTY_PRINT);

        // $data = Data::paginate(15);
        $data = DB::table('data')
        ->leftjoin('order_details', 'orderDetailId', '=', 'data.orderDetail')
        ->select('data.*', 'order_details.*')
        //->where('orderDetailId', '=', 1)
        ->paginate(5);

        //$data2 = Data::find(1);
        //foreach ($data2 as $d){
        //$res["orderDetail"] = $this->getData($data->orderId);
        //$res["order"] = $data;
        // // }
        // $res["orderDetail"] = $this->getData($data2->orderId);
        // $res["order"] = $data2;
        return response($data, 200);

    }

    public function getAllOrder(){
        $order = OrderDetail::get()->toJson(JSON_PRETTY_PRINT);

        return response($order, 200);
    }

    // public function createOrder(Request $request){
    //     $data = new OrderDetail;
    //     $data->orderDetailId = $request->orderId;
    //     $data->invoiceNumber = $request->invoiceNumber;
    //     $data->orderName = $request->orderName;
    //     $data->orderDetail = $request->orderDetail;
    //     $data->orderDescription =$request->orderDescription;
    //     $data->createBy = $request->createBy;
    //     $data->updateBy = $request->updateBy;
    //     $data->save();

    //     return response()->json([
    //         "message" => "data record created"
    //     ], 201);
    // }

    public function createData(Request $request){
        $data = new Data;
        $data->orderId = $request->orderId;
        $data->invoiceNumber = $request->invoiceNumber;
        $data->orderName = $request->orderName;
        $data->orderDetail = $request->orderDetail;
        $data->orderDescription =$request->orderDescription;
        $data->createBy = $request->createBy;
        $data->updateBy = $request->updateBy;
        $data->save();

        return response()->json([
            "message" => "data record created"
        ], 201);
    }

    public function getData($id){
        if (Data::where('orderId', $id)->exists()){
            $data = Data::where('orderId', $id)->get()->toJson(JSON_PRETTY_PRINT);
            $data = DB::table('data')
        ->leftjoin('order_details', 'orderDetailId', '=', 'data.orderDetail')
        ->select('data.*', 'order_details.*')
        ->where('orderDetailId', '=', 1)
        ->paginate(5);
            return response($data, 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
        // $data = Data::paginate(15);
    }

    public function updateData(Request $request, $id){
        if (Data::where('orderId', $id)->exists()){
            $data = Data::find($id);
            $data->invoiceNumber = is_null($request->invoiceNumber) ? $data->invoiceNumber : $request->invoiceNumber;
            $data->orderName = is_null($request->orderName) ? $data->orderName : $request->orderName;
            $data->orderDetail = is_null($request->orderDetail) ? $data->orderDetail : $request->orderDetail;
            $data->orderDescription = is_null($request->orderDescription) ? $data->orderDescription : $request->orderDescription;
            $data->created_at = is_null($request->created_at) ? $data->created_at : $request->created_at;
            $data->updated_at = is_null($request->updated_at) ? $data->updated_at : $request->updated_at;
            $data->createBy = is_null($request->createBy) ? $data->createBy : $request->createBy;
            $data->updateBy = is_null($request->updateBy) ? $data->updateBy : $request->updateBy;
            $data->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }

    }

    public function deleteData($id){
        if(Data::where('orderId', $id)->exists()) {
            $data = Data::find($id);
            $data->delete();

            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Data not found"
            ], 404);
          }

        // Data::findOrfail($id)->delete();
        // return response('Data deleted', 200);

    }
}
