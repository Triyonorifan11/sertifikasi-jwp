<?php

namespace App\Http\Controllers;

use App\Services\KeranjangService;
use App\Services\MasterProductService;
use App\Services\SalesOrderService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $data_cust = [
            'count_my_cart' => KeranjangService::count(),
            'count_so_send' => SalesOrderService::count_send(),
            'count_so_all' => SalesOrderService::count_all(),
            'count_need_order' => SalesOrderService::count_pack(),
            'product_count' => MasterProductService::count_product(),
            'count_send_order' => SalesOrderService::count_send()
        ];
        return view('home.home', $data_cust);
    }
}
