@extends('layouts.body')
@section('content')
<!-- Greet user with tailwiind  Hello, Name-->
<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">
        Hello, {{ Auth::user()->name }}. Always Happy With you!
    </h2>
    <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
</div>

<p class="text-gray-600">
    Welcome back to your web application.
</p>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
        <div class="report-box zoom-in">
            <div class="box p-5">
                <div class="flex">
                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i> 
                    
                </div>
                
                @if(Auth::user()->role->role_name == "Penjual")
                <div class="text-3xl font-medium leading-8 mt-6">{{number_format($count_so_all, 0, ',', '.')}}</div>
                <div class="text-base text-slate-500 mt-1">Your All Order</div>
                @else
                <div class="text-3xl font-medium leading-8 mt-6">{{number_format($count_my_cart, 0, ',', '.')}}</div>
                <div class="text-base text-slate-500 mt-1">Your Cart</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
        <div class="report-box zoom-in">
            <div class="box p-5">
                <div class="flex">
                    <i data-lucide="credit-card" class="report-box__icon text-pending"></i> 
                    
                </div>
                @if(Auth::user()->role->role_name == "Penjual")
                <div class="text-3xl font-medium leading-8 mt-6">{{number_format($count_need_order, 0, ',', '.')}}</div>
                @else
                <div class="text-3xl font-medium leading-8 mt-6">{{number_format($count_so_send, 0, ',', '.')}}</div>
                @endif
                <div class="text-base text-slate-500 mt-1">New Orders</div>
            </div>
        </div>
    </div>
    <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
        <div class="report-box zoom-in">
            <div class="box p-5">
                <div class="flex">
                    <i data-lucide="monitor" class="report-box__icon text-warning"></i> 
                </div>
                <div class="text-3xl font-medium leading-8 mt-6">{{number_format($product_count, 0, ',', '.')}}</div>
                <div class="text-base text-slate-500 mt-1">Total Our Products</div>
            </div>
        </div>
    </div>
    
</div>

@endsection
