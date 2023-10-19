<?php

namespace App\Services;

use App\Models\SalesOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;

class SalesOrderService
{
    public static function show()
    {
        $so = SalesOrder::paginate(10);
        return $so;
    }
    public static function show2()
    {
        $so = SalesOrder::where('user_id', Auth::user()->id)->paginate(10);
        return $so;
    }

    public static function count_send(){
        $cart = SalesOrder::where('user_id', Auth::user()->id)->where('status_so', 'Dikirim')->get();
        return $cart->count();
    }

    public static function create($data){ 
        $so = new SalesOrder();
        // $so->sales_order_no = "SO-".date('y') . date('m'). '-'.date('his');
        $so->sales_order_no = '';
        $so->product_id = $data['product_id'];
        $so->user_id = $data['user_id'];
        $so->so_qty = $data['so_qty'];
        $so->order_date = date ('Y-m-d H:i:s');
        $so->date_bayar = date ('Y-m-d H:i:s');
        $so->total_amt = $data['total_amt'];
        $so->detail_alamat = $data['detail_alamat'];
        $so->message_so = isset($data['message_so']) ? $data['message_so'] : '';
        $so->metode_bayar = $data['metode_bayar'];
        $so->status_so = 'Diminta';
        $so->save();
        return $so;
    }

    public static function updatestatus($data, $salesorder){

        if($data['status_so']=='Dikemas'){
            $salesorder->sales_order_no = "SO-".date('y') . date('m'). '-'.date('his');
        }else{
            $salesorder->sales_order_no = $data['sales_order_no'];
        }
        $salesorder->product_id = $data['product_id'];
        $salesorder->user_id = $data['user_id'];
        $salesorder->so_qty = $data['so_qty'];
        $salesorder->order_date = date ('Y-m-d H:i:s');
        $salesorder->date_bayar = date ('Y-m-d H:i:s');
        $salesorder->total_amt = $data['total_amt'];
        $salesorder->detail_alamat = $data['detail_alamat'];
        $salesorder->message_so = isset($data['message_so']) ? $data['message_so'] : '';
        $salesorder->metode_bayar = $data['metode_bayar'];
        $salesorder->status_so = $data['status_so'];
        $salesorder->save();
    }

}
