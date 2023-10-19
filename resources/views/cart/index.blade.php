@extends('layouts.body')
@section('content')
<!-- Greet user with tailwiind  Hello, Name-->
<h1 class="text-lg font-medium">
    {{$title}}
</h1>
<!-- Welcome back -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <div class="dropdown hidden">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
            </button>
            <div class="dropdown-menu w-40">
                <ul class="dropdown-content">
                    <li>
                        <a href="" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-slate-500">Page {{$cart->currentPage()}} | Total Data : {{$cart->total()}}</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500 hidden">
                <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">NO</th>
                    <th class="whitespace-nowrap">PRODUCT</th>
                    <th class="whitespace-nowrap">IMAGE</th>
                    <th class="whitespace-nowrap">QTY</th>
                    <th class="text-center whitespace-nowrap">ADD AT</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)

                <tr class="intro-x">
                    <td class="text-center w-10">{{$loop->iteration}}</td>
                    <td>
                        <div class="flex">
                            <a class="font-medium whitespace-nowrap" href="{{route('keranjang.edit',$item)}}"> {{$item->product->product_name}} </a>
                        </div>
                    </td>
                    <td class="w-40">
                        <div class="flex">
                            <div class="w-10 h-10 image-fit zoom-in">
                                <img alt="{{$item->product->product_name}}" class="tooltip rounded-full" src="{{ isset($item->product->product_image) ? asset('storage/assets/images/product/'.$item->product->product_image) : url('assets/images/product/'.$item->product->product_image) }}" title="{{$item->product->product_name}}">
                            </div>
                        </div>
                    </td>
                    <td class="text-center w-10">{{$item->qty}}</td>
                    <td class="text-center">{{$item->created_at->format('d/m/Y')}}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{route('keranjang.edit',$item)}}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Checkout </a>
                            <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal" onclick="deleteDataConfirm({{$item}})"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        {{$cart->links()}} 
    </div>
    <!-- END: Pagination -->
</div>

@endsection