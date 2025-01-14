<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\NotificationModel;
use App\Mail\OrderStatusMail;
use Mail;
use Auth;

class OrderController extends Controller
{
    public function list()
    {
        $data['getRecord'] = OrderModel::getRecord();
        $data['header_title'] = "Orders";
        return view('admin.order.list', $data);
    }

    public function order_detail($id)
    {
        $data['getRecord'] = OrderModel::getSingle($id);
        $data['header_title'] = "Order Detail";
        return view('admin.order.detail', $data);
    }

    public function order_status(Request $request)
    {
        $getOrder = OrderModel::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();

        //Notification
        $user_id = $getOrder->user_id;
        $url = url('user/orders');
        $message = "You Order Status Updated #".$getOrder->order_number;
        NotificationModel::insertRecord($user_id, $url, $message);

        Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));

        $json['message'] = "Status successfully updated";
        echo json_encode($json);

    }

}
